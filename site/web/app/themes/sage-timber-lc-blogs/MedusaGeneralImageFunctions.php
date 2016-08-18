<?php

namespace MedusaContentSuite\Images{

	use MedusaContentSuite\Functions\Common as Common;

	class MedusaGeneralImageFunctions{//change name specific to archive - move general image functions

		
		public function filePathParser( $filePath )
		{
			$sizeSpecificFileName = getSizeSpecificFileName( $filePath );

			Common::write_log( "sizeSpecificFileName - " );
			Common::write_log( $sizeSpecificFileName );

			$fileExt = getImageFileExt( $sizeSpecificFileName );

			Common::write_log( "fileExt - " );
			Common::write_log( $fileExt );

					//CREATE FUNCTION : getImageFileNameSizeSuffix
					// add start and end pos to return arrays
					//

					/*

					$genericFileName = removeImageSizeSuffix( $sizeSpecificFileName );

					#Common::write_log( "genericFileName - " . $genericFileName );

					$sizeSpecificFileName = getAttachmentIdFromFilename( $genericFileName );

					$output[] = $genericFileName;

					*/


		}












		public function getAttachmentIdFromFilename( $filename ) {
			global $wpdb;
			$query = "SELECT ID FROM {$wpdb->posts} WHERE post_type='attachment' AND guid LIKE '%$filename%'";
			Common::write_log( $query );
			$id = $wpdb->get_var($query);
			return $id;
		}


		public function getSizeSpecificFileName( $filepath ) {
			$end = strlen( $filepath );
			$i = $end-1;

			$count = 0;
			while( $filepath{$i} != '/' ) : 
				$i--; 
				$count++;
			endwhile;

			$start = $i;
			$filename = substr( $filepath, $start+1 );
			return $filename;
		}


		public function getFirstContentImageId( $post_content ) {
			global $wpdb;

			$first_img = '';
			$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post_content, $matches);

			if ( ! empty( $matches[1][0] ) ) :
				$filepath = $matches[1][0];
				$filename = getSizeSpecificFileName( $filepath );
				$id = getAttachmentIdFromFilename( $filename );
				return $id;
			endif;
		}


		public function getAttachmentImages( $post )
		{
			$attachments = get_post_gallery_images( $post );

			/*Common::write_log( "getAttachmentImages( )" );
			Common::write_log( $attachments );*/

			if( ! empty( $attachments ) ) :
				return $attachments;
			endif;
		}



		public function getImageFileExt( $filePath )
		{
			$fileExt = array( );
			$end = strlen( $filePath ) - 1 ;
			$i = $end;
			$count = 1;

			while( $filePath{$i} != '.' ) : 
				$count++;
				$i--; 
			endwhile;

			$start = $i;
			$fileExt['str'] = substr( $filePath, $start+1, $count );
			$fileExt['count'] = $count;

			return $fileExt;
		}


		public function removeImageSizeSuffix( $imgStr )
		{

			#Common::write_log( "removeImageSizeSuffix( imgStr ) - " . $imgStr );

			$end = strlen( $imgStr );
			$i = $end-1;

			while( $imgStr{$i} != '-' ) : $i--; endwhile;

			$start = $i;
			$newImgStr = substr( $imgStr, ( $start + 1 ) );
			return $newImgStr;

		}








	}

}
