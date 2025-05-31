<?php
require_once 'db.php'; 


function addToWatchlist($listName, $contentTitle, $contentType, $userEmail) {
    $conn = getConnection();

    
    $checkUser = "SELECT 1 FROM users WHERE email = ?";
    $checkStmt = mysqli_prepare($conn, $checkUser);
    mysqli_stmt_bind_param($checkStmt, "s", $userEmail);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) === 0) {
        
        mysqli_stmt_close($checkStmt);
        mysqli_close($conn);
        return false;
    }
    mysqli_stmt_close($checkStmt);

    
    $sql = "INSERT INTO watchlist (list_name, content_title, content_type, user_email)
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $listName, $contentTitle, $contentType, $userEmail);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $result;
}


// Get all unique watchlist names for a user
function getUserLists($userEmail) {
    $conn = getConnection();

    $sql = "SELECT DISTINCT list_name FROM watchlist WHERE user_email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $lists = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $lists[] = $row['list_name'];
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $lists;
}

// Get all items in a specific watchlist
function getItemsInList($userEmail, $listName) {
    $conn = getConnection();

    $sql = "SELECT * FROM watchlist WHERE user_email = ? AND list_name = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $userEmail, $listName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $items;
}

// Delete a specific item from the watchlist
function deleteItemById($id, $userEmail) {
    $conn = getConnection();

    $sql = "DELETE FROM watchlist WHERE id = ? AND user_email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "is", $id, $userEmail);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $result;
}

// Delete an entire watchlist by name
function deleteListByName($listName, $userEmail) {
    $conn = getConnection();

    $sql = "DELETE FROM watchlist WHERE list_name = ? AND user_email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $listName, $userEmail);
    
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $result;
}
?>
