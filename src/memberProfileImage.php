<?php
/**
 * Add field for member image on profile!
 *
 */
namespace bigreja\memberProfileImage;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;
use SilverStripe\Forms\FieldList;

class memberProfileImage extends DataExtension
{

    private static $db = [
    ];

	private static $has_one = array(
		'ProfileImage' =>  Image::class,
	);

	private static $owns = [
		'ProfileImage'
	];



	private static $summary_fields = array(
		'GridThumbnail' => 'Profile Image'
	);

   public function updateCMSFields(FieldList $fields)
{

        $image = new UploadField('ProfileImage', 'Profile Image');
        $image->setFolderName('ProfileImage');
        $image->getValidator()->setAllowedExtensions(['png','gif','jpeg','jpg']);


        $fields->addFieldsToTab('Root.Main', $image, 'FirstName');
    }


public function getGridThumbnail()
    {
        // $this->owner refers to the original instance. In this case a `Member`.

        if($this->owner->ProfileImage()->exists()) {
            return $this->owner->ProfileImage()->ScaleMaxHeight(50);
        }

        return "(no image)";
    }


}
