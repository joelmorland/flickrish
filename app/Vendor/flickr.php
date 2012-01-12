<?php
#flickr class written by Joel Morland
#phpFlickr written by Dan Coulter

#require phpFlickr class
require_once("phpFlickr.php");

class flickr extends phpFlickr
{     
    function searchPhotos($search='sunset', $page=1) 
    {        
        #get photos with extra params to get original format & dimensions
        $photos = $this->photos_search(array("tags"=>$search, "tag_mode"=>"any", "per_page"=>"5", "page"=>$page, "extras"=>"original_format,o_dims", "privacy_filter"=>1));
        
        //check that photos returned
        if (is_array($photos) && count($photos)) {
            #currently displayed photos
            $disp = ($page*5-5).' - '.($page*5);
            
            #add original URL & thumb to array 
            foreach ($photos['photo'] as &$photo) 
            {
                $photo['thumbnail']=$this->buildPhotoURL($photo,'thumbnail');
                $photo['original_url']=$this->imageURL($photo['id']);
            }
            
            #add search results and parameters to photo array and return
            return array_merge($photos, array('total'=>$photos['total'], 
                        'search'=>$search, 
                        'displaying'=>$disp));
        }
    }
    
    function pagination($cur, $pages, $search) {
        #flickr API only allows 4000 results to be returned - limit to 4000 otherwise dummy photos are displayed by flickr
        $pages=($pages>4000/5)?4000/5:$pages;         
        
        $pagination = '<div class="pagination">';
        
            $pagination .= ($cur>4)?"<a href='/flickrish/searches/search?query=$search&p=1'>1</a>":'';
            
            for ($i=$cur-2; $i<=$cur+2; $i++) {
                if ($i<1 || $i>$pages) continue; #ensure page not less than one or greater than last page
                $pagination .= ($i!=$cur)?"<a href='/flickrish/searches/search?query=$search&p=$i'>$i</a>":"<b>$i</b>";
            } 

            #ensure current
            $pagination .= ($cur<($pages-2))?"...<a href='/flickrish/searches/search?query=$search&p=$pages'>$pages</a>":'';

        return $pagination.'</div>';
    }
    
    function imageURL($photoID) {
        $photo = $this->photos_getInfo($photoID); #get photo format, size etc from photo id
        
        #if image is restricted from full resolution download, display as large        
        $size=(isset($photo['photo']['originalformat'], $photo['photo']['originalsecret']))?'original':'large';
        
        #return full size image url if permitted - otherwise largest image size
        return $this->buildPhotoURL($photo['photo'],$size);
    }
}
?>