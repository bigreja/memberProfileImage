<?php
/**
 * Add field for member image on profile!
 *
 */
namespace bigreja\memberprofileimage\Extensions;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;
use SilverStripe\Forms\FieldList;

class memberprofileimage extends DataExtension
{

    private static $db = [
    ];

	private static $has_one = array(
		'profileImage' =>  Image::class,
	);

	private static $owns = [
		'profileImage'
	];



	private static $summary_fields = array(
		'GridThumbnail' => 'Profile Image'
	);

   public function updateCMSFields(FieldList $fields)
{

        $image = new UploadField('profileImage', 'Profile Image');
        $image->setFolderName('profileImage');
        $image->getValidator()->setAllowedExtensions(['png','gif','jpeg','jpg']);


        $fields->addFieldsToTab('Root.Main', $image, 'FirstName');
    }


public function getGridThumbnail()
    {
        // $this->owner refers to the original instance. In this case a `Member`.

        if($this->owner->profileImage()->exists()) {
            return $this->owner->profileImage()->ScaleMaxHeight(50);
        }

        return "(no image)";
    }


}
