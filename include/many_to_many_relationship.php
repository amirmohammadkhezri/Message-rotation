<?php
$sql  = "SELECT
  users_id, 
  Student.name,
  Teacher.name AS teacher,
  subject.name AS subject
FROM
  Student
LEFT JOIN
  tbl_users ON user_id = tbl_users.user_id
LEFT JOIN
  Teacher_Subject ON Student_Subject.subject_id = Teacher_Subject.subject_id
LEFT JOIN
  Teacher ON Teacher_Subject.teacher_id = Teacher.id
LEFT JOIN subject ON
  Student_Subject.subject_id = subject.id
WHERE
  Student.name = 'Vikram'";

// $result = mysqlQuery($sql); // your custom function like using pdo or mysqli

$finalResult = [];
foreach ($result as $key => $value) {

    if (!isset($finalResult[$value['id']]['name'])) {
        $finalResult[$value['id']]['name'] = $value['name'];
    }

    $finalResult[$value['id']]['subjects_teacher'][] = [
            "teacher" => $value['teacher'],
            "subject" => $value['subject'],
        ];
}

print_r($finalResult);
?>