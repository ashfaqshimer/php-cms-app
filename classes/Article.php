<?php
/**
 * Article
 *
 * A piece of writing for publication
 */
class Article
{
    public $id;
    public $title;
    public $content;
    public $published_at;
    public $errors = [];

    /**
     * Insert the article into the database
     *
     *
     * @param object $conn Connection to the database
     *
     * @return boolean True if successful, false if execution failed
     **/
    public function create($conn)
    {
        if ($this->validate()) {
            $sql = "INSERT INTO article (title, content, published_at)
                    VALUES (:title, :content, :published_at)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }

            if ($stmt->execute()) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * Get all the articles
     *
     * @param object $conn Connection to the database
     *
     * @return array An associative array of all the article records
     *
     */
    public static function getAll($conn)
    {

        $sql = "SELECT *
            FROM article
            ORDER BY published_at;";

        $results = $conn->query($sql);

        return $results->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get the article record based on the ID
     *
     * @param object $conn Connection to the database
     * @param integer $id The article ID
     * @param string $columns Optional list of columns for the select. Defaults to * if no value is passed
     *
     * @return mixed An object of this class, or null if not found
     **/
    public static function getByID($conn, $id, $columns = '*')
    {
        $sql = "SELECT $columns FROM article WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');

        if ($stmt->execute()) {
            return $stmt->fetch();
        }
    }

    /**
     * Update the article in the database
     *
     *
     * @param object $conn Connection to the database
     *
     * @return boolean True if successful, false if execution failed
     **/
    public function update($conn)
    {
        if ($this->validate()) {
            $sql = "UPDATE article
            SET title = :title,
                content = :content,
                published_at = :published_at
            WHERE id = :id";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':content', $this->content, PDO::PARAM_STR);

            if ($this->published_at == '') {
                $stmt->bindValue(':published_at', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':published_at', $this->published_at, PDO::PARAM_STR);
            }

            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Validate the article properties, storing any validation error messages in the $errors property
     *
     * @return boolean True if the current properties are valid, false otherwise
     */

    protected function validate()
    {
        if ($this->title == '') {
            $this->errors[] = 'Title is required';
        }
        if ($this->content == '') {
            $this->errors[] = 'Content is required';
        }

        // if ($this->published_at !== '') {
        //     $date_time = date_create_from_format('m/d/Y h:i A', $this->published_at);

        //     if ($date_time === false) {
        //         $this->errors[] = 'Invalid date and time';
        //     } else {
        //         $date_errors = date_get_last_errors();
        //         if ($date_errors['warning_count'] > 0) {
        //             $this->errors[] = 'Invalid date and time';
        //         }
        //     }
        // }
        return empty($this->errors);
    }

    /**
     * Delete the current article
     *
     *
     * @param object $conn Connection to the database
     *
     * @return boolean True if successful, false if execution failed
     **/
    public function delete($conn)
    {
        $sql = "DELETE FROM article WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
