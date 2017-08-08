# PHP-IMAGE-UPLOAD-TOOLS
## A Library To Make Uploading And Validating Images Easier.
**By Conor Howland 26/05/2017**
**Note: DEV branch is much better, and I recconmend using it, it is pretty stable**
*Last Updated 08/08/17* 

### Resizing Images
img_resize($target,$newcopy,$w,$h)

**Variables:**

*$target - Original Photo Url
*$newcopy - Fully Qualified File Url To Move To
*$w - Width Of Output File
*$h - Height Of Output File

##isImageWithUpload($user)

###Variables:

*$user -  Unique Identifier For A Group Of Photos i.e Username For Profile Photos*
**Note: Uploaded File Must Be In $_FILES['fileToUpload'];** *Dev Branch Is On Allowing Changing The Selector*

### Code Example For Feed In Form (FeedIn.html):


	<form action="tools.php" method="post" enctype="multipart/form-data">
	<input type="file" name="fileToUpload" id="fileToUpload">
	<input type="submit" value="Upload Image" name="submit"><br><br>
	<span style="background-color: lightgray; border: 5px solid lightgrey; border-radius: 5px;"><b> By Uploading An Image You Are 	Stating That You Have Full Ownership / Copy-</span><br><br><span style="background-color: lightgray; border: 5px solid lightgrey; border-radius: 5px;">rights For The Photo, and give permission for it to be displayed publically on site</b></span>

### generateAllSizesOfImage($origloc) 
*Dev Branch - Allows You To choose the text to replace w/ filesize*

#### Variables:

*origloc - File To Create All Sizes From, Should Contain "Orig" in the filename as that will be changed to image width / height*
i.e: JohnSmith_234532469643_orig.png ->

					* JohnSmith_234532469643_256.png (256x256)
					
					* JohnSmith_234532469643_128.png (128x128)
					
					* JohnSmith_234532469643_64.png (64x64)
					
**Note: Its good to have a wide array of images so that you can save download time on pages where images are smaller.**

*This Function Creates 256x256,128x128,64x64 as well as leaving the original.*

*Small One: Friends List, My Account Button. Large: Profile Page. Medium: Group Members.*
