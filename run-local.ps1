<#
Run this from the `kuku-biashara` folder to start a local PHP server.
It will try to find `php.exe` on PATH or common XAMPP install locations.
Usage:
  Open PowerShell
  cd "d:\AI PROJECT\kuku-biashara"
  .\run-local.ps1
#>

param(
    [int]$Port = 8000
)

# Find php.exe
$phpCmd = Get-Command php -ErrorAction SilentlyContinue
if ($phpCmd) {
    $phpPath = $phpCmd.Source
} else {
    $candidates = @(
        'C:\xampp\php\php.exe',
        'C:\Program Files\\xampp\\php\\php.exe',
        'C:\Program Files (x86)\\xampp\\php\\php.exe',
        'D:\xampp\php\php.exe'
    )
    $phpPath = $null
    foreach ($c in $candidates) {
        if (Test-Path $c) { $phpPath = $c; break }
    }
}

if (-not $phpPath) {
    Write-Error "php.exe not found. Install PHP or XAMPP, or add php to PATH."
    Write-Output "Common XAMPP path: C:\xampp\php\php.exe"
    exit 1
}

# Change to the script directory (so server serves this folder)
$scriptDir = Split-Path -Path $MyInvocation.MyCommand.Path -Parent
Push-Location $scriptDir

Write-Output "Starting PHP built-in server using: $phpPath"
Write-Output "Open http://localhost:$Port in your browser. Use Ctrl+C here to stop."

& "$phpPath" -S "localhost:$Port" -t .

Pop-Location
