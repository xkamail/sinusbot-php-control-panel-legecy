<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 Sinusbot.class 5.0G www.ts3siam.com 5555555
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

class SinusBot {
  public $wiURL = NULL;
  public $wiToken = NULL;
  public $wiTimeout = NULL;
  public $apiURL = NULL;
  public $botUUID = NULL;
  public $instanceUUID = NULL;

  public function login($username, $password) {
    $login = $this->request('/bot/login', 'POST', json_encode(array('username' => $username, 'password' => $password, 'botId' => $this->botUUID)));
    if ($login != NULL AND isset($login['token'])) $this->wiToken = $login['token'];
    return $login;
  }
  
  public function getFiles() {
    return $this->request('/bot/files');
  }
  
  public function getRadioStations($search = "") {
    return $this->request('/bot/stations?q='.urlencode($search));
  }
  
  public function getStatus($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/status');;
  }
  
  public function getInfos() {
    return $this->request('/bot/info');
  }
  
  public function getInstanceLog($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/log');
  }
  
  public function getPlaylists() {
    return $this->request('/bot/playlists');
  }
  
  public function createPlaylist($playlistName) {
    return $this->request('/bot/playlists', 'POST', json_encode(array("name" => $playlistName)));
  }
  
  public function renamePlaylist($playlistName, $playlistUUID) {
    return $this->request('/bot/playlists/'.$playlistUUID, 'PATCH', json_encode(array("name" => $playlistName)));
  }
  
  public function deletePlaylist($playlistUUID) {
    return $this->request('/bot/playlists/'.$playlistUUID, 'DELETE');
  }
  
  public function getPlaylistTracks($playlistUUID) {
    return $this->request('/bot/playlists/'.$playlistUUID);
  }
  
  public function addPlaylistTrack($trackUUID, $playlistUUID) {
    return $this->request('/bot/playlists/'.$playlistUUID, 'POST', json_encode(array("uuid" => $trackUUID)));
  }
  
  public function deletePlaylistTrack($trackPosition, $playlistUUID) {
    return $this->request('/bot/playlists/'.$playlistUUID.'/'.$trackPosition, 'DELETE');
  }
  
  public function deletePlaylistTracks($playlistUUID) {
    $currentTracks = $this->getPlaylistTracks($playlistUUID);
    if ($currentTracks == NULL OR !is_array($currentTracks)) return NULL;
    
    return $this->request('/bot/bulk/playlist/'.$playlistUUID.'/files', 'POST', json_encode(array("op" => "delete", "files" => array_keys($currentTracks['entries']))));
  }
  
  public function getQueueTracks($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/queue');
  }
  
  public function appendQueueTrack($trackUUID, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/queue/append/'.$trackUUID, 'POST', "");
  }
  
  public function prependQueueTrack($trackUUID, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/queue/prepend/'.$trackUUID, 'POST', "");
  }
  
  public function deleteQueueTrack($trackPosition, $instanceUUID) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    
    $currentTracks = $this->getQueueTracks($instanceUUID);
    if ($currentTracks == NULL OR !is_array($currentTracks)) return NULL;
    unset($currentTracks[$trackPosition]);
    
    return $this->request('/bot/i/'.$instanceUUID.'/queue', 'PATCH', json_encode(array_values($currentTracks)));
  }
  
  public function deleteQueueTracks($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/queue', 'PATCH', json_encode(array()));
  }
  
  public function say($text, $locale, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/say', 'POST', json_encode(array("text" => $text, "locale" => $locale)));
  }
  
  public function playTrack($trackUUID, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/play/byId/'.$trackUUID, 'POST', '');
  }
  
  public function playURL($url, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/playUrl?url='.urlencode($url), 'POST', '');
  }
  
  public function playPlaylist($playlistUUID, $playlistIndex = 0, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/play/byList/'.$playlistUUID.'/'.$playlistIndex, 'POST', '');
  }
  
  public function playPrevious($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/playPrevious', 'POST', '');
  }
  
  public function playNext($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/playNext', 'POST', '');
  }
  
  public function playRepeat($repeatState = 1, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/repeat/'.$repeatState, 'POST', '');
  }
  
  public function playShuffle($shuffleState = 1, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/shuffle/'.$shuffleState, 'POST', '');
  }
  
  public function stop($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/stop', 'POST', '');
  }
  
  public function seekPlayback($position = 0, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/seek/'.$position, 'POST', '');
  }
  
  public function getPlayedTracks($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/recent', 'POST', '');
  }
  
  public function moveTrack($trackUUID, $parent = "") {
    return $this->request('/bot/files/'.$trackUUID, 'PATCH', json_encode(array("parent" => $parent)));
  }
  
  public function editTrack($trackUUID, $title, $artist = "", $album = "") {
    return $this->request('/bot/files/'.$trackUUID, 'PATCH', json_encode(array("displayTitle" => $title, "title" => $title, "artist" => $artist, "album" => $album)));
  }
  
  public function deleteTrack($trackUUID) {
    return $this->request('/bot/files/'.$trackUUID, 'DELETE');
  }
  
  public function getVolume($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->getStatus($instanceUUID)['volume'];
  }
  
  public function setVolume($volume = 50, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/volume/set/'.$volume, 'POST', '');
  }
  
  public function setVolumeUp($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/volume/up', 'POST', '');
  }
  
  public function setVolumeDown($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/volume/down', 'POST', '');
  }
  
  public function addURL($url, $title, $parent = "") {
    return $this->request('/bot/url', 'POST', json_encode(array("url" => $url, "title" => $title, "parent" => $parent)));
  }
  
  public function addFolder($folderName = "Folder", $parent = "") {
    return $this->request('/bot/folders', 'POST', json_encode(array("name" => $folderName, "parent" => $parent)));
  }
  
  public function moveFolder($folderUUID, $parent = "") {
    return $this->moveTrack($folderUUID, $parent);
  }
  
  public function renameFolder($folderName, $folderUUID) {
    return $this->request('/bot/files/'.$folderUUID, 'PATCH', json_encode(array("uuid" => $folderUUID, "type" => "folder", "title" => $folderName)));
  }
  
  public function deleteFolder($folderUUID) {
    return $this->deleteTrack($folderUUID);
  }
  
  public function getJobs() {
    return $this->request('/bot/jobs');
  }
  
  public function addJob($URL) {
    return $this->request('/bot/jobs', 'POST', json_encode(array('url'=>$URL)));
  }
  
  public function deleteJob($jobUUID) {
    return $this->request('/bot/jobs/'.$jobUUID, 'DELETE');
  }
  
  public function deleteFinishedJobs() {
    return $this->request('/bot/jobs', 'DELETE');
  }
  
  public function uploadTrack($path) {
    return $this->request('/bot/upload', 'POST', file_get_contents($path));
  }
  
  public function uploadAvatar($path, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;    
    return $this->request('/bot/i/'.$instanceUUID.'/avatar', 'POST', file_get_contents($path));
  }
  
  public function deleteAvatar($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/avatar', 'DELETE');
  }
  
  public function getUsers() {
    return $this->request('/bot/users');
  }
  
  public function addUser($username, $password, $privileges = 0) {
    return $this->request('/bot/users', 'POST', json_encode(array('username'=>$username, 'password'=>$password, 'privileges'=>$privileges)));
  }
  
  public function setUserPassword($password, $userUUID) {
    return $this->request('/bot/users/'.$userUUID, 'PATCH', json_encode(array('password'=>$password)));
  }
  
  public function setUserPrivileges($privileges, $userUUID) {
    return $this->request('/bot/users/'.$userUUID, 'PATCH', json_encode(array('privileges'=>$privileges)));
  }
  
  public function setUserIdentity($identity, $userUUID) {
    return $this->request('/bot/users/'.$userUUID, 'PATCH', json_encode(array('tsuid'=>$identity)));
  }
  
  public function setUserServergroup($groupID, $userUUID) {
    return $this->request('/bot/users/'.$userUUID, 'PATCH', json_encode(array('tsgid'=>$groupID)));
  }
  
  public function deleteUser($userUUID) {
    return $this->request('/bot/users/'.$userUUID, 'DELETE');
  }
  
  public function getSettings($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/settings');
  }
  
  public function editSettings($data, $instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/settings', 'POST', json_encode($data));
  }
  
  public function getChannels($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/channels');
  }
  
  public function getInstances() {
    return $this->request('/bot/instances');
  }
  
  public function selectInstance($instanceUUID) {
    if ($this->getStatus($instanceUUID) == NULL) {
      return false;
    } else {
      $this->instanceUUID = $instanceUUID;
      return true;
    }
  }
  
  public function createInstance($nickname = "TS3index.com MusicBot", $backend = "ts3") {
    return $this->request('/bot/instances', 'POST', json_encode(array("backend" => $backend, "nick" => $nickname)));
  }
  
  public function deleteInstance($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/instances/'.$instanceUUID, 'DELETE');
  }
  
  public function spawnInstance($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/spawn', 'POST', '');
  }
  
  public function respawnInstance($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/respawn', 'POST', '');
  }
  
  public function killInstance($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return $this->request('/bot/i/'.$instanceUUID.'/kill', 'POST', '');
  }
  
  public function getWebStream($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    $token = $this->getWebStreamToken($instanceUUID);
    if ($token == NULL) return NULL;
    
    return $this->apiURL.'/bot/i/'.$instanceUUID.'/stream/'.$token;
  }
  
  public function getWebStreamToken($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    $tokenRequest = $this->request('/bot/i/'.$instanceUUID.'/streamToken', 'POST', '');
    return (isset($tokenRequest['token'])) ? $tokenRequest['token'] : NULL;
  }
  
  public function getDefaultBot() {
    $botRequest = $this->request('/botId');
    return (isset($botRequest['defaultBotId'])) ? $botRequest['defaultBotId'] : NULL;
  }
  
  public function getBotLog() {
    return $this->request('/bot/log');
  }
  
  public function getThumbnail($thumbnail) {
    return $this->wiURL.'/cache/'.$thumbnail;
  }
  
  public function isPlaying($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return (boolean) $this->getStatus($instanceUUID)['playing'];
  }
  
  public function isRunning($instanceUUID = NULL) {
    if ($instanceUUID == NULL) $instanceUUID = $this->instanceUUID;
    return (boolean) $this->getStatus($instanceUUID)['running'];
  }
  
  function __construct($wiURL = 'http://127.0.0.1:8087', $botUUID = NULL, $wiTimeout = 8000) {
    $this->wiURL = $wiURL;
    $this->apiURL = $this->wiURL.'/api/v1';
    $this->wiTimeout = $wiTimeout;
    $this->botUUID = ($botUUID == NULL) ? $this->getDefaultBot() : $botUUID;
  }
  
  function __destruct() {
  }
  
  function __call($name, $args) {
    return 'Method '.$name.' doesn\'t exist';
  }
  
  private function request($path, $method = "GET", $fields = NULL) {
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $this->apiURL.$path,
        CURLOPT_HTTPHEADER => array(
            "Accept:application/json, text/plain, */*",
            "Accept-Encoding:gzip, deflate",
            "Content-Type:application/json",
            "Authorization: Bearer ".$this->wiToken
        ),
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT_MS => $this->wiTimeout
    ));
    if ($fields != NULL) curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
    $data = curl_exec($ch);
    
    if ($data === false) {
      $data = array('success' => false, 'error' => curl_error($ch));
    } else {
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      if ($httpcode != 200 AND $httpcode != 201) $data = array('success' => false, 'error' => $this->getError($httpcode));
    }
    
    curl_close($ch);
    return (is_array($data)) ? $data : json_decode($data, TRUE);
  }
   
  private function getError($code = 0) {
    switch ($code) {
        case 100: return 'Continue';
        case 101: return 'Switching Protocols';
        case 200: return 'OK';
        case 201: return 'Created';
        case 202: return 'Accepted';
        case 203: return 'Non-Authoritative Information';
        case 204: return 'No Content';
        case 205: return 'Reset Content';
        case 206: return 'Partial Content';
        case 300: return 'Multiple Choices';
        case 301: return 'Moved Permanently';
        case 302: return 'Moved Temporarily';
        case 303: return 'See Other';
        case 304: return 'Not Modified';
        case 305: return 'Use Proxy';
        case 400: return 'Bad Request';
        case 401: return 'Unauthorized';
        case 402: return 'Payment Required';
        case 403: return 'Forbidden';
        case 404: return 'Not Found';
        case 405: return 'Method Not Allowed';
        case 406: return 'Not Acceptable';
        case 407: return 'Proxy Authentication Required';
        case 408: return 'Request Time-out';
        case 409: return 'Conflict';
        case 410: return 'Gone';
        case 411: return 'Length Required';
        case 412: return 'Precondition Failed';
        case 413: return 'Request Entity Too Large';
        case 414: return 'Request-URI Too Large';
        case 415: return 'Unsupported Media Type';
        case 500: return 'Internal Server Error';
        case 501: return 'Not Implemented';
        case 502: return 'Bad Gateway';
        case 503: return 'Service Unavailable';
        case 504: return 'Gateway Time-out';
        case 505: return 'HTTP Version not supported';
        default: return 'Unknown HTTP status code: ' . $code;
    }
  }
}
