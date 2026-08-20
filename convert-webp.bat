@echo off
:: Image WebP Conversion Script for dr-praveen.com
:: Requires: cwebp.exe in PATH or same directory

set ASSETS_DIR=C:\Users\Veer\Desktop\office\dr-praveen\assets
set WEBP_DIR=%ASSETS_DIR%\webp

:: Create WebP directory if not exists
if not exist "%WEBP_DIR%" mkdir "%WEBP_DIR%"

echo.
echo ==========================================
echo  WebP Image Conversion for dr-praveen.com
echo ==========================================
echo.

:: Count files
set PNG_COUNT=0
set JPG_COUNT=0
set CONVERTED=0

:: Process PNG files
for %%f in ("%ASSETS_DIR%\*.png") do (
    set /a PNG_COUNT+=1
    set "SOURCE=%%~ff"
    set "FILENAME=%%~nf"
    echo Converting PNG: %FILENAME%.png
    
    :: Try cwebp first
    if exist "cwebp.exe" (
        cwebp -q 85 "%SOURCE%" "%WEBP_DIR%\%FILENAME%.webp" >nul 2>&1
        if errorlevel 0 (
            set /a CONVERTED+=1
            echo  -> Converted to WebP
        ) else (
            echo  -> cwebp failed, copying original
            copy "%SOURCE%" "%WEBP_DIR%\%FILENAME%.webp"
        )
    ) else (
        echo  -> cwebp not found, copying original
        copy "%SOURCE%" "%WEBP_DIR%\%FILENAME%.webp"
    )
)

:: Process JPG files
for %%f in ("%ASSETS_DIR%\*.jpg") do (
    set /a JPG_COUNT+=1
    set "SOURCE=%%~ff"
    set "FILENAME=%%~nf"
    echo Converting JPG: %FILENAME%.jpg
    
    :: Try cwebp first
    if exist "cwebp.exe" (
        cwebp -q 85 "%SOURCE%" "%WEBP_DIR%\%FILENAME%.webp" >nul 2>&1
        if errorlevel 0 (
            set /a CONVERTED+=1
            echo  -> Converted to WebP
        ) else (
            echo  -> cwebp failed, copying original
            copy "%SOURCE%" "%WEBP_DIR%\%FILENAME%.webp"
        )
    ) else (
        echo  -> cwebp not found, copying original
        copy "%SOURCE%" "%WEBP_DIR%\%FILENAME%.webp"
    )
)

:: Process JPEG files
for %%f in ("%ASSETS_DIR%\*.jpeg") do (
    set /a JPG_COUNT+=1
    set "SOURCE=%%~ff"
    set "FILENAME=%%~nf"
    echo Converting JPEG: %FILENAME%.jpeg
    
    :: Try cwebp first
    if exist "cwebp.exe" (
        cwebp -q 85 "%SOURCE%" "%WEBP_DIR%\%FILENAME%.webp" >nul 2>&1
        if errorlevel 0 (
            set /a CONVERTED+=1
            echo  -> Converted to WebP
        ) else (
            echo  -> cwebp failed, copying original
            copy "%SOURCE%" "%WEBP_DIR%\%FILENAME%.webp"
        )
    ) else (
        echo  -> cwebp not found, copying original
        copy "%SOURCE%" "%WEBP_DIR%\%FILENAME%.webp"
    )
)

echo.
echo ==========================================
echo  Conversion Complete!
echo.
echo  Summary:
echo   PNG files processed: %PNG_COUNT%
echo   JPG/JPEG files processed: %JPG_COUNT%
echo   Total converted to WebP: %CONVERTED%
echo   Total files in webp directory: %CONVERTED%
echo.
echo  WebP files saved to: %WEBP_DIR%
echo.
echo  Next steps:
echo  1. Verify images display correctly on the website
echo  2. Update HTML to use <picture> tags with WebP source
echo  3. Test page load speeds in Chrome DevTools
echo.
pause