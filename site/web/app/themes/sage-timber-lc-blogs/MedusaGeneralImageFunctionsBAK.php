<?php

namespace MedusaGeneralImageFunctions{

	use MedusaContentSuite\Functions\Common as Common;

	class MedusaGeneralImageFunctions{//change name specific to archive - move general image functions

		protected $imageSourceType;
		protected $imageId;
		protected $posts;

		function __construct( $posts )
		{
			$this->posts = $posts;
			$this->setImageSourceType( );
			$this->setFirstImageId( );
		}

		public function getImageSourceType( )
		{
			return $this->imageSourceType;
		}

		public function setImageSourceType( )
		{
			foreach( $this->posts as $p ) : 

				//Common::write_log( $p->post_name );

				if( $this->checkGalleryImageExists( $p ) ) : 

					$this->imageSourceType = 'gallery';

					/*
						Common::write_log( "getFirstGalleryImageId selected" );
						Common::write_log( $p->post_name . " - " .  $p->id . " image :- " );
						Common::write_log( $image );

						elseif( $image = getFirstContentImageId( $p->post_content ) ) : 

						Common::write_log( "getFirstContentImageId selected" );
						Common::write_log( $p->post_name . " - " .  $p->id . " image :- " );
						Common::write_log( $image );

						elseif( $image = getAttachmentImages( $p ) ) : 

						Common::write_log( "getAttachmentImages selected" );
						Common::write_log( $p->post_name . " - " .  $p->id . " image :- " );
						Common::write_log( $image );
					*/
				
				else : 

					Common::write_log( "else********" );

				endif;

			endforeach;

			return $this;
		}

		public function setFirstImageId( )
		{
			if( $this->imageSourceType = 'gallery' ) :
				$this->setFirstGalleryImageId( );
			endif;
		}



		public function setFirstGalleryImageId(  )
		{
			$galleryImages = get_post_gallery_images( $post );

			$output = array( );

			
			Common::write_log( "galleryImages" );
			Common::write_log( $galleryImages );

			return;
			

			if( ! empty( $galleryImages ) ) :

				$output = array( );

				foreach( $galleryImages as $filePath ) :

					Common::write_log( "filePath - " . $filePath );
					
					//filePathParser( $filePath );

				endforeach;
			
				return $output;
			
			endif;

		}




		public function checkGalleryImageExists( $post )
		{
			$galleryImages = get_post_gallery_images( $post );
			return count( $galleryImages );
		}

		
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
