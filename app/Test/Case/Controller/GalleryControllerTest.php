<?php
#import my flickr class (which imports phpFlickr)
App::import('Vendor', 'flickr');

class GalleryController extends CakeTestCase 
{
    public $name = 'Gallery';
    public $helpers = array('Html', 'Form');
    
    public function testIndex() 
    {       
        #instantiate the flickr class
        $flickr = new flickr("0469684d0d4ff7bb544ccbb2b0e8c848"); 
             
        #check if search performed, otherwise default to 'sunset'
        $page=(isset($this->params['url']['p']))?$this->params['url']['p']:1;
        $search=(isset($this->params['url']['query']))?$this->params['url']['query']:'sunset';
          
        #execute search function
        $photos = $flickr->searchPhotos($search, $page);
        $pagination = $flickr->pagination($page,$photos['pages'],$search);
        
        echo $pagination;
        
        #ensure photo index in array
        $this->assertTrue(array_key_exists('photo', $photos)); 
        
        #ensure 5 photos are returned
        $this->assertTrue(count($photos['photo'])==5);    
        
        #ensure page, results + search in array
        $this->assertTrue(isset($photos['total'], $photos['displaying'], $photos['search'], $photos['pages']));
        
        #ensure pagination returns
        $this->assertTrue(substr_count($pagination, '<div class="pagination">') > 0);
        
        #ensure pagination links
        $this->assertTrue(substr_count($pagination, '<a href') > 0);
         
    }    
}

?>