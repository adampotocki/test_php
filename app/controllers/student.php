<?php

  require_once(dirname(__FILE__) . '/../../db/connection.php');
  require_once(dirname(__FILE__) . '/../models/student.php');

  DEFINE('TABLE_NAME', 'student_table');

  class StudentController {

    public function __construct() {
      try {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . TABLE_NAME . '(
          id SERIAL PRIMARY KEY ,
          name CHARACTER VARYING(255) NOT NULL,
          dob DATE NOT NULL,
          active BOOLEAN NOT NULL
        );';
        $stmt = Connection::get_db()->prepare($sql);
        $stmt->execute();
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function addStudent($student) {
      try {
        $sql = 'INSERT INTO ' . TABLE_NAME . ' (name, dob, active) VALUES (:name, :dob, :active)';
        $stmt = Connection::get_db()->prepare($sql);
        $stmt->bindValue(':name', $student->getName());
        $stmt->bindValue(':dob', $student->getDob());
        $stmt->bindValue(':active', $student->getActive());
        return $stmt->execute();
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function updateStudent($student) {
      try {
        $sql = 'UPDATE ' . TABLE_NAME . ' SET name = :name, dob = :dob, active = :active WHERE id = :id';
        $stmt = Connection::get_db()->prepare($sql);
        $stmt->bindValue(':name', $student->getName());
        $stmt->bindValue(':dob', $student->getDob());
        $stmt->bindValue(':active', $student->getActive());
        $stmt->bindValue(':id', $student->getId());
        return $stmt->execute();
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function getStudents() {
      try {
        $sql = 'SELECT * FROM ' . TABLE_NAME . ' ORDER BY ID DESC';
        $stmt = Connection::get_db()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Student');
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function deleteStudent($student) {
      try {
        $sql = 'DELETE FROM ' . TABLE_NAME . ' WHERE id = :id';
        $stmt = Connection::get_db()->prepare($sql);
        $stmt->bindValue(':id', $student->getId());
        return $stmt->execute();
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function findById($student) {
      try {
        $sql = 'SELECT * FROM ' . TABLE_NAME . ' WHERE id = ?';
        $stmt = Connection::get_db()->prepare($sql);
        $stmt->bindValue(1, $student->getId());
        $stmt->execute();
        return $stmt->fetch();
      } catch (Exception $e) {
        throw $e;
      }
    }

  }