<?php
/**
 * @var yii\web\View $this
 */
use frontend\components\Voh;
?>
<h1>complaint/view</h1>
<?php
    $voh = new Voh();
    $complaint =  $voh->hashTag('I dislike #adabraka_branch #lovely very much. They are a bunch of lazy #bankers');
    print_r($complaint);
    echo "<p>&nbsp;</p>";   
    echo $voh->linkTag('I dislike #adabraka_branch very much. They are a bunch of lazy #bankers');
 
    
