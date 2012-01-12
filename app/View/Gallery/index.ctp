<?php 
    $this->Html->css('style', null, array('inline' => false));
?>

<h1>Flickrish</h1>
      

<div id="search">
    <?php             
    echo $this->Form->create('search',array('action'=>'search','type'=>'get'));
                    
    echo $this->Form->input('query'); 
                            
    echo $this->Form->end('Search')
    ?>
</div>     
        
<div id="notice">
    Found <?php echo $photos['total']; ?> photos for query '<?php echo $photos['search']; ?>' [limit: 4000]<br />
    Displaying <?php echo $photos['displaying']; ?>
</div>
        
<div id='gallery'>
<?php             
    foreach ($photos['photo'] as $photo) 
    {
        echo $this->Html->link(
                $this->Html->image($photo['thumbnail'], array("alt" => $photo['title'], 'class'=>'galleryImage')),
                $photo['original_url'],
                array('escape' => false, 'target'=>'_blank')
            );                                
    } 
?>
</div>


<?php echo $pagination; ?>  

