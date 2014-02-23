<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MessageModel
 *
 * @author anhvn
 */
class MessageModel extends Model {

    public static $instance = null;

    public function __construct() {
        parent::__construct();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new MessageModel();
        }
        return self::$instance;
    }

    public function insert($message, $user_id) {
        try {
            $message = trim($message);
            $stmt = $this->db->prepare("INSERT INTO messages (user_id, message, create_at, update_at) 
            VALUES (:user_id, :message, :create_at, :update_at)");

            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':message', $message);
            $current_time = time();
            $stmt->bindParam(':create_at', $current_time);
            $stmt->bindParam(':update_at', $current_time);
            if (!$stmt->execute()) {
                throw new Exception(implode(',', $stmt->errorInfo()));
            };
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * 
     * @param type $getIdBefore
     * @param type $getIdAfter
     * @param type $limit
     * @return type
     * @throws Exception
     */
    public function getMessages($getIdBefore = null, $getIdAfter = null, $limit = null) {
        $str_stmt = "SELECT message_id, m.user_id AS user_id, message,
             create_at, update_at, username, flag FROM messages m
            INNER JOIN users u ON m.user_id=u.user_id WHERE flag < 2";
        if ($getIdBefore !== null)
            $getIdBefore = intval($getIdBefore);
        if ($getIdAfter !== null)
            $getIdAfter = intval($getIdAfter);
        if ($limit !== null)
            $limit = intval($limit);

        $bindData = array();

        // WHERE
        if ($getIdBefore !== null) {
            $str_stmt .= ' AND m.message_id < :idbefore';
            $bindData[':idbefore'] = $getIdBefore;
        }

        if ($getIdAfter !== null) {
            $str_stmt .= ' AND m.message_id > :idafter';
            $bindData[':idafter'] = $getIdAfter;
        }

        // ORDER BY
        $str_stmt.=' ORDER BY m.message_id DESC';


        if ($limit !== null) {
            $str_stmt .= ' LIMIT 0, :limit';
            $bindData[':limit'] = $limit;
        }

        $stmt = $this->db->prepare($str_stmt);

        foreach ($bindData as $key => $value) {
            $stmt->bindParam($key, $value, PDO::PARAM_INT);
        }

        if ($stmt->execute()) {
            $messages = array();
            if ($stmt->rowCount() > 0) {
                while ($mess = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $messages[] = $mess;
                }
            }
            return array_reverse($messages);
        } else {
            throw new Exception(implode(',', $stmt->errorInfo()));
        }
    }

    public function getMessageById($message_id) {
        try {
            $message_id = intval($message_id);
            $stmt = $this->db->prepare("SELECT * FROM messages WHERE message_id = :message_id LIMIT 0, 1");
            $stmt->bindParam(':message_id', $message_id);
            if (!$stmt->execute()) {
                throw new Exception(implode(',', implode(',', $stmt->errorInfo())));
            } else {
                if ($stmt->rowCount() > 0) {
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }
                return false;
            };
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getUpdatedList($last_update) {
        if (!$last_update)
            return array();
        $last_update = intval($last_update);
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE flag > 0 AND update_at >= :update_at");
        $stmt->bindParam(':update_at', $last_update);
        if ($stmt->execute()) {
            $messages = array();
            if ($stmt->rowCount() > 0) {
                while ($mess = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $mess['update_time_formated'] = StringUtils::formatTimeStamp($mess['update_at'], MESSAGE_TIME_FORMAT);
                    $messages[] = $mess;
                }
            }
            return array_reverse($messages);
        } else {
            throw new Exception(implode(',', $stmt->errorInfo()));
        }
    }

    public function deleteMessage($message_id) {
        try {
            $message_id = intval($message_id);
            $stmt = $this->db->prepare("UPDATE messages SET flag = 2, update_at = :update_at WHERE message_id=:message_id");
            $current_time = time();
            $stmt->bindParam(':update_at', $current_time);
            $stmt->bindParam(':message_id', $message_id);
            if (!$stmt->execute()) {
                throw new Exception(implode(',', $stmt->errorInfo()));
            };
             if($stmt->rowCount() > 0){
                return $current_time;
            }
            return false;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function editMessage($message_id, $user_id, $message) {
        try {
            $message_id = intval($message_id);
            $stmt = $this->db->prepare("UPDATE messages SET flag = 1, 
                update_at = :update_at, message = :message 
                WHERE message_id=:message_id AND user_id = :user_id");
            $current_time = time();
            $stmt->bindParam(':update_at', $current_time);
            $stmt->bindParam(':message_id', $message_id);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':message', $message);
            if (!$stmt->execute()) {
                throw new Exception(implode(',', $stmt->errorInfo()));
            };
            if($stmt->rowCount() > 0){
                return $current_time;
            }
            return false;
        } catch (Exception $e) {
            throw $e;
        }
    }

}

?>
