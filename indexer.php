<?PHP

require("./getid3/getid3.php");

$our_mp3 = getID3();
$counter = 25;
$counted = 0;
function listFiles( $from = '.')
{
	global $counter,$counted;
    if(! is_dir($from))
        return false;
   
    $files = array();
    $dirs = array( $from);
    while( NULL !== ($dir = array_pop( $dirs)))
    {
        if( $dh = opendir($dir))
        {
            while( false !== ($file = readdir($dh)))
            {
                if( $file == '.' || $file == '..')
                    continue;
                $path = $dir . '/' . $file;
                if( is_dir($path)){
                    $dirs[] = $path;
                }else{
                    $files[] = $path;
					
					print $path . "\n";
					print_r($our_mp3->analyze($path));
					$counted++;
					if($counter == $counted){
						exit();
					}
				}
            }
            closedir($dh);
        }
    }
    return $files;
}

print_r(listFiles(("/home/alexkess/mymp3.tastestalkr.com/mp3s"));
?>