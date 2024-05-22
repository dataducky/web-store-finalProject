<?php

require_once('db_fns_duck.php');

function register_user($username, $password, $confpass) {
	// confirm password == confirmation password
	// then, update users db with username & password info
	if ($password == $confpass) {
	$conn = db_connect();
	if (!$conn) {
		return 0;
    }
	// ensure unique username
	$verify = $conn->query("select * from users
        where username='". $conn->real_escape_string($username)."'");
	if (!$verify) {
     return 0;
	}

	if ($verify->num_rows>0) {
     return 0;
	} else {
    $query = "insert into users values
            ('" . $conn->real_escape_string($username) ."',sha1('" . $conn->real_escape_string($password) . "'),0)";
    $result = $conn->query($query);
	return 1;
	}
	}
}
	

function login($username, $password) {
// check username and password with db
// if yes, return true
// else return false

  // connect to db
  $conn = db_connect();
  if (!$conn) {
    return 0;
  }

  // check if username is unique
  $result = $conn->query("select * from users
                         where username='". $conn->real_escape_string($username)."'
                         and password = sha1('". $conn->real_escape_string($password)."')
						 and hasadmin = 1");
  if (!$result) {
     return 0;
  }

  if ($result->num_rows>0) {
     return 1;
  } else {
     return 0;
  }
}

function usercheck($username, $password) {
// check username and password with db
// if yes, return true
// else return false

  // connect to db
  $conn = db_connect();
  if (!$conn) {
    return 0;
  }

  // check if username is unique
  $result = $conn->query("select * from users
                         where username='". $conn->real_escape_string($username)."'
                         and password = sha1('". $conn->real_escape_string($password)."')");
  if (!$result) {
     return 0;
  }

  if ($result->num_rows>0) {
     return 1;
  } else {
     return 0;
  }
}

function check_admin_user() {
// see if somebody is logged in and notify them if not

  if (isset($_SESSION['admin_user'])) {
    return true;
  } else {
    return false;
  }
}

function check_user() {
// see if somebody is logged in and notify them if not

  if (isset($_SESSION['user'])) {
    return true;
  } else {
    return false;
  }
}

function change_password($username, $old_password, $new_password) {
// change password for username/old_password to new_password
// return true or false

  // if the old password is right
  // change their password to new_password and return true
  // else return false
  if (login($username, $old_password)) {

    if (!($conn = db_connect())) {
      return false;
    }

    $result = $conn->query("update users
                            set password = sha1('". $conn->real_escape_string($new_password)."')
                            where username = '". $conn->real_escape_string($username) ."'");
    if (!$result) {
      return false;  // not changed
    } else {
      return true;  // changed successfully
    }
  } else {
    return false; // old password was wrong
  }
}

function promote_user ($username, $userpromoted, $password) {
	if (login($username, $password)) {

    if (!($conn = db_connect())) {
      return false;
    }

    $result = $conn->query("update users
                            set hasadmin = 1
                            where username = '". $conn->real_escape_string($userpromoted) ."'");
    if (!$result) {
      return false;  // not changed
    } else {
      return true;  // changed successfully
    }
  } else {
    return false; // old password was wrong
  }
}

function demote_user ($username, $userdemoted, $password) {
	if (login($username, $password)) {

    if (!($conn = db_connect())) {
      return false;
    }

    $result = $conn->query("update users
                            set hasadmin = 0
                            where username = '". $conn->real_escape_string($userdemoted) ."'");
    if (!$result) {
      return false;  // not changed
    } else {
      return true;  // changed successfully
    }
  } else {
    return false; // old password was wrong
  }
}
?>
