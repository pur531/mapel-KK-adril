<?php 

session_start(); 

if (!isset($_SESSION['username'])) { 

 header("Location: index.php"); 

} 

?> 

<!DOCTYPE html> 

<html lang="en"> 

<head> 

 <meta charset="UTF-8"> 

 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

 <title>Welcome</title> 
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color:
}
</style>
</head> 

 <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2> 
 <h2>Daftar Makanan Dan Minuman </h2>
<table>
  <thead>
  <tr style="background-color: #dddddd;">
    <th>No.</th>
    <th>Makanan</th>
    <th>Minuman</th>
  </tr>
</thead>
 
  <tr>
    <td>1</td>
    <td>burger chessy</td>
    <td>coca cola</td>
  </tr>
  <tr>
    <td>2</td>
    <td>ayam teriyaki</td>
    <td>soda gembira</td>
  </tr>
  <tr>
    <td>3</td>
    <td>ayam yakiniku</td>
    <td>kopi susu</td>
  </tr>
  <tr>
    <td>4</td>
    <td>kentang goreng</td>
    <td>teh tarik</td>
  </tr>
  <tr>
    <td>5</td>
    <td>nasi goreng</td>
    <td>teh susu</td>
  </tr>
  <tr>
    <td>6</td>
    <td>tahu tek</td>
    <td>jus apel</td>
  </tr>
</table>
<p><a href="logout.php">Logout</a></p>