<?php

/**
 * Get the article record based on the ID
 *
 * @param object $conn Connection to the database
 * @param integer $id The article ID
 * @param string $columns Optional list of columns for the select. Defaults to * if no value is passed
 *
 * @return mixed An associative array containing the article based on the ID, or null if not found
 **/

function getArticle($conn, $id, $columns = '*')
{
    $sql = "SELECT $columns FROM article WHERE id = :id";

    $stmt = $conn->prepare($sql);

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

/**
 * Validate the article properties
 *
 * @param string $title Title, required
 * @param string $content Content, required
 * @param string $published_at Published date and time. Null if left empty
 *
 * @return array An array of validation error messages
 */

function validateArticle($title, $content, $published_at)
{
    $errors = [];

    if ($title == '') {
        $errors[] = 'Title is required';
    }
    if ($content == '') {
        $errors[] = 'Content is required';
    }

    // if ($published_at !== '') {
    //     $date_time = date_create_from_format('m/d/Y h:i A', $published_at);

    //     if ($date_time === false) {
    //         $errors[] = 'Invalid date and time';
    //     } else {
    //         $date_errors = date_get_last_errors();
    //         if ($date_errors['warning_count'] > 0) {
    //             $errors[] = 'Invalid date and time';
    //         }
    //     }
    // }
    return $errors;
}
