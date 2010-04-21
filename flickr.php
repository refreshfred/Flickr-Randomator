<h1>Flickr Randomator</h1>
<p>Be amazed as two interesting photos have their images and words combined.</p>

<?
// include phpFlickr library
include('phpFlickr-2.3.1/phpFlickr.php');

// create phpFlickr object
$apikey = '5d935f70a40edf3b239013d1663b09ac';
$f = new phpFlickr($apikey);

// get today's interesting photos
$photos = $f->interestingness_getList(null, 'url_m,title,description,tags');
if(isset($photos['total']) && $photos['total'] > 2) {
    // select a random photo as the image
    $count = count($photos['photo']);
    $image = mt_rand(0, $count-1);
    // select a different random photo as the words
    // ensure that it has a title and description
    $words = $image;
    while($words === $image || empty($photos['photo'][$words]['title']) || empty($photos['photo'][$words]['description']))
        $words = mt_rand(0, $count-1);
    // display the image and words together
    echo '<h2>'.$photos['photo'][$words]['title'].'</h2>';
    echo '<img src="'.$photos['photo'][$image]['url_m'].'" /><br />';
    echo '<p>'.nl2br($photos['photo'][$words]['description']).'</p>';
    if(!empty($photos['photo'][$words]['tags']))
        echo '<hr>'.$photos['photo'][$words]['tags'];
// not enough good photos
} else {
    echo "<p>Not enough photos. Lame.</p>";
}
?>

<hr />
<p><a href="http://www.flickr.com/services/api">Flickr API documentation</a></p>
<p><a href="http://phpflickr.com">phpFlickr project page</a></p>
<p>For more API awesomeness, go to <a href="http://www.programmableweb.com/apis">programmableweb.com</a></p>
<p>Created by <a href="http://refreshfred.com">Refresh Fred</a></p>