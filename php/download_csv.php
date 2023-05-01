<?php
session_start();

if (isset($_POST['csv-submit'])) {
  // Generate the CSV file
  $filename = 'crime_data.csv';
  $fp = fopen($filename, 'w');

  // Write the column headers to the file
  $headers = array('Area Name', 'Latitude', 'Longitude', 'Crime', 'Time');
  fputcsv($fp, $headers);

  // Loop through the location data and write each row to the file
  $num_rows = count($_SESSION['locations']);
  $counter = 0;
  foreach ($_SESSION['locations'] as $location) {
    $row = array($location['area_name'], $location['lat'], $location['lng'], $location['crime'], $location['time']);
    fputcsv($fp, $row);
    $counter++;
    if ($counter == $num_rows) {
      break;
    }
  }

  fclose($fp);

  // Read the contents of the CSV file
  $csv = file_get_contents($filename);

  // Output the CSV data to the browser
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="crime_data.csv"');
  echo $csv;
}
?>
