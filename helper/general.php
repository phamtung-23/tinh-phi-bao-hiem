<?php
function logEntry($message)
{
  $logFile = '../logs/debug.txt';
  $timestamp = date("Y-m-d H:i:s");
  // get full path
  $filePath = $_SERVER['PHP_SELF'];
  $logMessage = "[$timestamp] $filePath: $message\n";
  file_put_contents($logFile, $logMessage, FILE_APPEND);
}

function extractAge($input)
{
  preg_match('/\d+/', $input, $matches);
  return $matches[0] ?? null; // Return the first match or null if no match is found
}

function getFullNameBH($key)
{
  $names = [
    'ATSH' => 'AN TÂM SONG HÀNH',
    'ATDT' => 'AN THỊNH ĐẦU TƯ',
  ];

  return $names[$key] ?? '';
}

function getFieldValue($value)
{
  $optionsName = [
    'co_ban' => 'Cơ Bản',
    'pho_thong' => 'Phổ Thông',
    'dac_biet' => 'Đặc Biệt',
    'cao_cap' => 'Cao Cấp',
    'thinh_vuong' => 'Thịnh Vương'
  ];

  if (isset($optionsName[$value])) {
    return $optionsName[$value];
  } else {
    return $value;
  }
}

// Extract the part after the first colon ':'
function extractAfterColon($input) {
  $parts = explode(':', $input, 2); // Split into two parts by the first ':'
  return isset($parts[1]) ? trim($parts[1]) : 0; // Return trimmed part after ':' or null if not present
}
