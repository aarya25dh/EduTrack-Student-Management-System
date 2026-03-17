<?php

require 'db_connect.php';

$students = [

    ['1', 'Aarya Dhungana', 23, 'F', 'Kupondole, Lalitpur, Nepal', 'aaryadhungana@gmail.com', '9823456789', 'CSIT', '6th'],
    ['2', 'Aashraya Bhattarai', 22, 'M', 'New Baneshwor, Kathmandu, Nepal', 'aashrayabhattarai@gmail.com', '9811111111', 'BCA', '5th'],
    ['3', 'Aadarsha Shrestha', 23, 'M', 'Bhaktapur, Nepal', 'aadarshashrestha@gmail.com', '9768900897', 'CSIT', '6th'],
    ['4', 'Akash Khati', 21, 'M', 'Itahari, Sunsari, Nepal', 'akashkhati@gmail.com', '9743216780', 'BE', '4th'],
    ['5', 'Alex Maharjan', 22, 'M', 'Thamel, Kathmandu, Nepal', 'alexmaharjan@gmail.com', '9800089123', 'CSIT', '5th'],
    ['6', 'Aman Bhatta', 23, 'M', 'Pokhara, Kaski, Nepal', 'amanbhatta@gmail.com', '9814567890', 'BBA', '6th'],
    ['7', 'Aman Kumar Tiwari', 22, 'M', 'Dharan, Sunsari, Nepal', 'amantiwari@gmail.com', '9710002300', 'CSIT', '5th'],
    ['8', 'Ankita Shrestha', 21, 'F', 'Patan, Lalitpur, Nepal', 'ankitashrestha@gmail.com', '9745671209', 'CSIT', '4th'],
    ['9', 'Barshika Shah', 22, 'F', 'New Road, Kathmandu, Nepal', 'barshikashah@gmail.com', '9809098789', 'BSW', '5th'],
    ['10', 'Bishesh Shrestha', 23, 'M', 'Bhaktapur, Nepal', 'bisheshshrestha@gmail.com', '9811110110', 'CSIT', '6th'],
    ['11', 'Biswash Shahi Thakuri', 22, 'M', 'Dang, Nepal', 'biswashshahi@gmail.com', '9712171111', 'CSIT', '5th'],
    ['12', 'Chumalung Chamling', 23, 'M', 'Illam, Nepal', 'chumalungchamling@gmail.com', '9809090909', 'CSIT', '6th'],
    ['13', 'Deepika Khanal', 21, 'F', 'Lalitpur, Nepal', 'deepikakhanal@gmail.com', '9812341567', 'BCA', '4th'],
    ['14', 'Dipsan Silwal', 22, 'M', 'Bhaktapur, Nepal', 'dipsansilwal@gmail.com', '9811110909', 'CSIT', '5th'],
    ['15', 'Grishma Shakya', 23, 'F', 'Gairidhara, Kathmandu, Nepal', 'grishmashakya@gmail.com', '9878987908', 'CSIT', '6th'],
    ['16', 'Jamuna Silwal', 22, 'F', 'Banepa, Kavrepalanchok, Nepal', 'jamunasilwal@gmail.com', '9789065432', 'BSW', '5th'],
    ['17', 'Keepa Maharjan', 23, 'F', 'Kathmandu, Nepal', 'keepamaharjan@gmail.com', '9876509834', 'CSIT', '6th'],
    ['18', 'Kiran Kumari Shah', 21, 'F', 'New Baneshwor, Kathmandu, Nepal', 'kiranshah@gmail.com', '9876456789', 'CSIT', '4th'],
    ['19', 'Milisha Sapkota', 22, 'F', 'Lalitpur, Nepal', 'milishasapkota@gmail.com', '9789543210', 'BCA', '5th'],
    ['20', 'Nikatta Shah', 21, 'F', 'Thamel, Kathmandu, Nepal', 'nikattashah@gmail.com', '9800000000', 'CSIT', '4th'],
    ['21', 'Nisha Dhungana', 22, 'F', 'Kupondole, Lalitpur, Nepal', 'nishadhungana@gmail.com', '9878967567', 'CSIT', '5th'],
    ['22', 'Nitesh Khanal', 23, 'M', 'Bhaktapur, Nepal', 'niteshkhanal@gmail.com', '9788888899', 'CSIT', '6th'],
    ['23', 'Pragati Gurung', 22, 'F', 'Pokhara, Kaski, Nepal', 'pragatigurung@gmail.com', '9845121212', 'BSW', '5th'],
    ['24', 'Punyawati Bastakoti', 21, 'F', 'Kathmandu, Nepal', 'punyawatibastakoti@gmail.com', '9765450000', 'BBA', '4th'],
    ['25', 'Renusha Titaju', 22, 'F', 'Lalitpur, Nepal', 'renushatitaju@gmail.com', '9809878900', 'CSIT', '5th'],
    ['26', 'Ritsav Shrestha', 23, 'M', 'Bhaktapur, Nepal', 'ritsavshrestha@gmail.com', '9898989898', 'CSIT', '6th'],
    ['27', 'Saksham Dhungana', 22, 'M', 'Kupondole, Lalitpur, Nepal', 'sakshamdhungana@gmail.com', '9787878790', 'CSIT', '5th'],
    ['28', 'Saksham Pokharel', 22, 'M', 'New Road, Kathmandu, Nepal', 'sakshampokharal@gmail.com', '9876765656', 'CSIT', '5th'],
    ['29', 'Subin Timalsina', 21, 'M', 'Itahari, Sunsari, Nepal', 'subintimalsina@gmail.com', '9800999099', 'BE', '4th'],
    ['30', 'Subodh Timalsina', 22, 'M', 'Itahari, Sunsari, Nepal', 'subodhtimalsina@gmail.com', '9800999000', 'BE', '5th'],
    ['31', 'Sujan Shrestha', 23, 'M', 'Bhaktapur, Nepal', 'sujanshrestha@gmail.com', '9778899000', 'CSIT', '6th'],
    ['32', 'Yogesh Thapa', 22, 'M', 'Pokhara, Kaski, Nepal', 'yogeshthapa@gmail.com', '9800999000', 'BBA', '5th'],
    ['33', 'Supranjal Khadka', 23, 'M', 'Kathmandu, Nepal', 'supranjalkhadka@gmail.com', '9777777888', 'CSIT', '6th']

];

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO students (student_id, name, age, gender, address, email, phone, course, semester)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
);

foreach ($students as $s) {
    mysqli_stmt_bind_param($stmt, "ssissssss", $s[0], $s[1], $s[2], $s[3], $s[4], $s[5], $s[6], $s[7], $s[8]);
    mysqli_stmt_execute($stmt);
}

echo "Seed complete.\n";
?>