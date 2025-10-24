<?php
echo "PHP is working!";
echo "<br>";
echo "Current directory: " . getcwd();
echo "<br>";
echo "Server info: " . $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown';
?>
