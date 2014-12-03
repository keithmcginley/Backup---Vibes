<?php
/*
 * Title:   MySQL Points to GeoJSON
 * Notes:   Query a MySQL table or view of points with x and y columns and return the results in GeoJSON format, suitable for use in OpenLayers, Leaflet, etc.
 * Author:  Bryan R. McBride, GISP
 * Contact: bryanmcbride.com
 * GitHub:  https://github.com/bmcbride/PHP-Database-GeoJSON
 */

header('Access-Control-Allow-Origin: *');

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

# Connect to MySQL database mysql2275int.cp.blacknight.com ex mysql2275.cp.blacknight.com
$conn = new PDO('mysql:host=mysql2275.cp.blacknight.com;dbname=db1029802_sensus','u1029802_sensus','>P<o,P2.qr');

$emoTypeFilter = $_GET["emoTypes"];
$sqlTimeFilter = '';
# where string 
$timeType = $_GET["timeType"];
$interval = $_GET["interval"];
#$timeFilter = $_GET["time"];
if($timeType == 'fastButtons')
{
    $sqlTimeFilter = 'DATE_SUB(NOW(), INTERVAL ';
    if($interval == 'HOUR')
    {
        $sqlTimeFilter = $sqlTimeFilter .'8 HOUR) AND NOW()';
    }
    else
    {
       $sqlTimeFilter = $sqlTimeFilter .'1 ' .$interval .') AND NOW()';
    }
}
else if ($timeType == 'default')
{
    // Set to 6 months change to 1 day or 8 hours when live
    $sqlTimeFilter = 'DATE_SUB(NOW(), INTERVAL 6 MONTH ) AND NOW()';
}

# Build SQL SELECT statement including x and y columns
$sql = 'SELECT postID, emoType, postLat, postLong FROM emotionPosts WHERE emoType REGEXP ' .$emoTypeFilter .' AND timeServer BETWEEN ' .$sqlTimeFilter;
# $sql = 'SELECT postID, emoType, postLat, postLong FROM emotionPosts WHERE timeServer BETWEEN SUBDATE(CURDATE(), INTERVAL 1 MONTH) AND NOW();';

/*
* If bbox variable is set, only return records that are within the bounding box
* bbox should be a string in the form of 'southwest_lng,southwest_lat,northeast_lng,northeast_lat'
* Leaflet: map.getBounds().pad(0.05).toBBoxString()

if (isset($_GET['bbox']) || isset($_POST['bbox'])) {
    $bbox = explode(',', $_GET['bbox']);
    $sql = $sql . ' WHERE postLat <= ' . $bbox[2] . ' AND postLat >= ' . $bbox[0] . ' AND postLong <= ' . $bbox[3] . ' AND postLong >= ' . $bbox[1];
}*/

# Try query or error
$rs = $conn->query($sql);
if (!$rs) {
    echo 'An SQL error occured.\n';
    exit;
}

# Build GeoJSON feature collection array
$geojson = array(
   'type'      => 'FeatureCollection',
   'features'  => array()
);

# Loop through rows to build feature arrays
while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
    $properties = $row;
    # Remove x and y fields from properties (optional)
    unset($properties['postLat']);
    unset($properties['postLong']);
    $feature = array(
        'type' => 'Feature',
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => array(
                $row['postLong'],
                $row['postLat']
            )
        ),
        'properties' => $properties
    );
    # Add feature arrays to feature collection array
    array_push($geojson['features'], $feature);
}

header('Content-type: application/json');
echo json_encode($geojson);
$conn = NULL;
?>
