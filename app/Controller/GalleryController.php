<?php
#import my flickr class (which imports phpFlickr)
App::import('Vendor', 'flickr');

class GalleryController extends AppController 
{
    public $name = 'Gallery';
    public $helpers = array('Html', 'Form');
    
    public function index() 
    {       
        #instantiate the flickr class
        $flickr = new flickr("0469684d0d4ff7bb544ccbb2b0e8c848"); 
             
        #check if search performed, otherwise default to 'sunset'
        $page=(isset($this->params['url']['p']))?$this->params['url']['p']:1;
        $search=(isset($this->params['url']['query']))?$this->params['url']['query']:'sunset';
        
        #set page title
        $this->set('title_for_layout', "Flickrish '$search' | P$page");
               
        #execute search function
        $photos = $flickr->searchPhotos($search, $page);        
        
        #set photos variable for retrieval in page view
        $this->set('photos', $photos);
        
        #set pagination for retrieval in page view
        $this->set('pagination', $flickr->pagination($page,$photos['pages'],$search));  
    }    
}

?>