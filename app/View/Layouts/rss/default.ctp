<?php  
if (!isset($documentData)) {
    $documentData = array();
}
if (!isset($channelData)) {
    $channelData = array();
}
if (!isset($channelData['title'])) {
    $channelData['title'] = $this->fetch('title');
}
$channel = $this->Rss->channel(array(), $channelData, $this->fetch('content'));
echo $this->Rss->document($documentData, $channel);
?>


<?php
// if (!isset($channel)):
// 	$channel = array();
// endif;
// if (!isset($channel['title'])):
// 	$channel['title'] = $this->fetch('title');
// endif;

// echo $this->Rss->document(
// 	$this->Rss->channel(
// 		array(), $channelData, $this->fetch('content')
// 	)
// );
?>


