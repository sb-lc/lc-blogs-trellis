<?php

#change to archive image post
#

namespace MedusaContentSuite\Images{

	use MedusaContentSuite\Functions\Common as Common;
	use MedusaContentSuite\Images\MedusaGeneralImageFunctions as MedusaGeneralImageFunctions;

	//$medusaGeneralImageFunctions = new MedusaContentSuite\Images\MedusaGeneralImageFunctions( $posts );

	class MedusaArchiveImageFunctions{//change name specific to archive - move general image functions

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

			return $this;
		}


		public function setFirstGalleryImageId( )
		{

			$galleryImages = get_post_gallery_images( $post );

			$output = array( );
			
			Common::write_log( "galleryImages: " );
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




	}

}
