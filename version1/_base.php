<?php
// ============================================================================
// PHP Setups
// ============================================================================

date_default_timezone_set('Asia/Kuala_Lumpur');
session_start();

// ============================================================================
// General Page Functions
// ============================================================================
function cleanup_deactivated_users() {
    global $_db;
    $cleanup_stm = $_db->prepare('UPDATE user SET status = ? WHERE status = ? AND deactivated_at <= (NOW() - INTERVAL 1 MINUTE)');
    $cleanup_stm->execute(['Banned', 'Deactivate']);
}

function generateID($table, $column, $prefix = '', $length) {
    global $_db;
    // Query to get the maximum ID currently in the specified column of the specified table
    $query = "SELECT MAX($column) AS max_id FROM $table";
    
    try {
        $stmt = $_db->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Extract the numeric part and increment it
        if ($row && $row['max_id']) {
            $max_id = $row['max_id'];
            $numeric_part = intval(substr($max_id, strlen($prefix))); // Remove prefix and convert to integer
            $new_numeric_part = $numeric_part + 1;
        } else {
            $new_numeric_part = 1; // If no records, start with 1
        }

        // Format the new ID with leading zeros
        $new_id = $prefix . str_pad($new_numeric_part, $length, '0', STR_PAD_LEFT);

        return $new_id;
    } catch (PDOException $e) {
        // Handle query failure
        error_log("Error generating new ID: " . $e->getMessage());
        return false;
    }
}


// Is GET request?
function is_get()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// Is POST request?
function is_post()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

// Obtain GET parameter
function get($key, $value = null)
{
    $value = $_GET[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}

// Obtain POST parameter
function post($key, $value = null)
{
    $value = $_POST[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}

// Obtain REQUEST (GET and POST) parameter
function req($key, $value = null)
{
    $value = $_REQUEST[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}

// Redirect to URL
function redirect($url = null)
{
    $url ??= $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit();
}
// Set or get temporary session variable
function temp($key, $value = null)
{
    if ($value !== null) {
        $_SESSION["temp_$key"] = $value;
    } else {
        $value = $_SESSION["temp_$key"] ?? null;
        unset($_SESSION["temp_$key"]);
        return $value;
    }
}

// Obtain uploaded file --> cast to object
function get_file($key)
{
    $f = $_FILES[$key] ?? null;

    if ($f && $f['error'] == 0) {
        return (object)$f;
    }

    return null;
}
function get_file_multiple($key) {
    $files = [];
    if (!empty($_FILES[$key])) {
        foreach ($_FILES[$key]['name'] as $index => $name) {
            if ($_FILES[$key]['error'][$index] === UPLOAD_ERR_OK) {
                $file = new stdClass();
                $file->name = $_FILES[$key]['name'][$index];
                $file->type = $_FILES[$key]['type'][$index];
                $file->tmp_name = $_FILES[$key]['tmp_name'][$index];
                $file->error = $_FILES[$key]['error'][$index];
                $file->size = $_FILES[$key]['size'][$index];
                $files[] = $file;
            }
        }
    }
    return $files;
}

function get_mail() {
    require_once 'lib/PHPMailer.php';
    require_once 'lib/SMTP.php';

    $m = new PHPMailer(true);
    $m->isSMTP();
    $m->SMTPAuth = true;
    $m->Host = 'smtp.gmail.com';
    $m->Port = 587;
    $m->Username = 'webbmit2013@gmail.com';
    $m->Password = 'jyta epfs vott vgtc';
    $m->CharSet = 'utf-8';
    $m->setFrom($m->Username, '😺 Admin');

    return $m;
}

function save_photo($file) {
    // If $file is a string (file path)
    if (is_string($file)) {
        $file_tmp_name = $file;
        $file_type = mime_content_type($file);
        $file_size = filesize($file);
    }
    // If $file is an object (like $_FILES['photo'])
    elseif (is_object($file)) {
        $file_tmp_name = $file->tmp_name;
        $file_type = $file->type;
        $file_size = $file->size;
    }
    // If $file is an array (like $_FILES['photo'])
    elseif (is_array($file)) {
        $file_tmp_name = $file['tmp_name'];
        $file_type = $file['type'];
        $file_size = $file['size'];
    } else {
        throw new InvalidArgumentException('Invalid file input');
    }

    $photo = uniqid() . '.jpg';
    require_once 'lib/SimpleImage.php';
    $img = new SimpleImage();
    $img->fromFile($file_tmp_name)
        ->thumbnail(200, 200)
        ->toFile("uploads/$photo", 'image/jpeg');
    
    return $photo;
}


function save_photo_admin($file) {
    // If $file is a string (file path)
    if (is_string($file)) {
        $file_tmp_name = $file;
        $file_type = mime_content_type($file);
        $file_size = filesize($file);
    }
    // If $file is an object (like $_FILES['photo'])
    elseif (is_object($file)) {
        $file_tmp_name = $file->tmp_name;
        $file_type = $file->type;
        $file_size = $file->size;
    }
    // If $file is an array (like $_FILES['photo'])
    elseif (is_array($file)) {
        $file_tmp_name = $file['tmp_name'];
        $file_type = $file['type'];
        $file_size = $file['size'];
    } else {
        throw new InvalidArgumentException('Invalid file input');
    }

    $photo = uniqid() . '.jpg';
    require_once '../lib/SimpleImage.php';
    $img = new SimpleImage();
    $img->fromFile($file_tmp_name)
        ->thumbnail(200, 200)
        ->toFile("../uploads/$photo", 'image/jpeg');
    
    return $photo;
}


// Is money?
function is_money($value)
{
    return preg_match('/^\-?\d+(\.\d{1,2})?$/', $value);
}

function is_username($value)
{
    return preg_match('/^[a-zA-Z][a-zA-Z]+$/', $value);
}

// Is email?
function is_email($value)
{
    return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
}

function is_birthday($value){
    return preg_match('/^\d{4}-\d{2}-\d{2}$/', $value); 
}

function is_gender($value){
    return in_array($value, ['Male', 'Female', 'Other']);
}

// ============================================================================
// HTML Helpers
// ============================================================================

// Placeholder for TODO
function TODO()
{
    echo '<span>TODO</span>';
}

// Encode HTML special characters
function encode($value)
{
    return htmlentities($value);
}

// Generate <input type='hideen'>
function html_hidden($key, $attr = '')
{
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='hidden' id='$key' name='$key' value='$value' $attr>";
}

// Generate <input type='text'>
function html_text($key, $attr = '')
{
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='text' id='$key' name='$key' value='$value' $attr>";
}

// Generate <input type='date'>
function html_date($key, $attr = '')
{
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='date' id='$key' name='$key' value='$value' $attr>";
}

// Generate <input type='password'>
function html_password($key, $attr = '')
{
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='password' id='$key' name='$key' value='$value' $attr>";
}

// Generate <input type='number'>
function html_number($key, $min = '', $max = '', $step = '', $attr = '')
{
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='number' id='$key' name='$key' value='$value'
                 min='$min' max='$max' step='$step' $attr>";
}

// Generate <input type='search'>
function html_search($key, $attr = '')
{
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='search' id='$key' name='$key' value='$value' $attr>";
}

// Generate <input type='radio'> list
function html_radios($key, $items, $br = false)
{
    $value = encode($GLOBALS[$key] ?? '');
    echo '<div>';
    foreach ($items as $id => $text) {
        $state = $id == $value ? 'checked' : '';
        echo "<label><input type='radio' id='{$key}_$id' name='$key' value='$id' $state>$text</label>";
        if ($br) {
            echo '<br>';
        }
    }
    echo '</div>';
}

// Generate <select>
function html_select($key, $items, $default = '- Select One -', $attr = '')
{
    $value = encode($GLOBALS[$key] ?? '');
    echo "<select id='$key' name='$key' $attr>";
    if ($default !== null) {
        echo "<option value=''>$default</option>";
    }
    foreach ($items as $id => $text) {
        $state = $id == $value ? 'selected' : '';
        echo "<option value='$id' $state>$text</option>";
    }
    echo '</select>';
}

function html_textarea($key, $attr = '') {
    $value = encode($GLOBALS[$key] ?? '');
    echo "<textarea id ='$key' name='$key' $attr>$value</textarea>";
}

// Generate <input type='file'>
function html_file($key, $accept = '', $attr = '')
{
    echo "<input type='file' id='$key' name='$key' accept='$accept' $attr>";
}

// Generate table headers <th>
function table_headers($fields, $sort, $dir, $href = '')
{
    foreach ($fields as $k => $v) {
        $d = 'asc'; // Default direction
        $c = '';    // Default class

        if ($k == $sort) {
            $d = $dir == 'asc' ? 'desc' : 'asc';
            $c = $dir;
        }

        echo "<th><a href='?sort=$k&dir=$d&$href' class='$c'>$v</a></th>";
    }
}

// ============================================================================
// Error Handlings
// ============================================================================

// Global error array
$_err = [];

// Generate <span class='err'>
function err($key)
{
    global $_err;
    if ($_err[$key] ?? false) {
        echo "<span class='err'>$_err[$key]</span>";
    } else {
        echo '<span></span>';
    }
}

// ============================================================================
// Security
// ============================================================================

// Global user object
$_user = $_SESSION['user'] ?? null;

//Auth
function auth(...$roles) {
    global $_user;
    if ($_user) {
        if (empty($roles) || in_array($_user->role, $roles)) {
            return; 
        }
    }
    
    temp('info', 'Please Login...');
    redirect('../login.php');
}


// Login user
function login($user, $url = '/')
{
    $_SESSION['user'] = $user;
    redirect($url);
}

// Logout user
function logout($url = '/')
{
    unset($_SESSION['user']);
    redirect($url);
}
// ============================================================================
// Database Setups and Functions
// ============================================================================

// Global PDO object
$_db = new PDO('mysql:dbname=web_ass', 'root', '', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);

function is_unique($value, $table, $field) {
    global $_db;
    $stm = $_db->prepare("SELECT COUNT(*) FROM $table WHERE $field = ?");
    $stm->execute([$value]);
    return $stm->fetchColumn() == 0;
}

// Is exists?
function is_exists($value, $table, $field) {
    global $_db;
    $stm = $_db->prepare("SELECT COUNT(*) FROM $table WHERE $field = ?");
    $stm->execute([$value]);
    return $stm->fetchColumn() > 0;
}

/**
 * Extract table name from CREATE TABLE query
 */
function getTableNameFromQuery($query) {
    if (preg_match('/CREATE TABLE `?(\w+)`?/i', $query, $matches)) {
        return $matches[1];
    }
    return null;
}

/**
 * Extract table name from INSERT INTO query
 */
function getTableNameFromInsertQuery($query) {
    if (preg_match('/INSERT INTO `?(\w+)`?/i', $query, $matches)) {
        return $matches[1];
    }
    return null;
}

/**
 * Extract values from INSERT INTO query
 */
function extractValuesFromInsertQuery($query) {
    if (preg_match('/VALUES\s?\(([^)]+)\)/i', $query, $matches)) {
        return explode(',', $matches[1]);
    }
    return null;
}

/**
 * Get primary key column(s) for a table
 */
function getPrimaryKeyColumn($conn, $tableName) {
    $query = "SHOW KEYS FROM `$tableName` WHERE Key_name = 'PRIMARY'";
    $stmt = $conn->query($query);
    $primaryKey = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $primaryKey ? $primaryKey['Column_name'] : null;
}

// ============================================================================
// Global Constants and Variables
// ============================================================================
cleanup_deactivated_users();


