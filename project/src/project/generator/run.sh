RELATIVE_DIR=$(dirname "$0")
cd "$RELATIVE_DIR"
SHELL_PATH=$(pwd -P)
cd "$SHELL_PATH"
chmod -R 777 .
php generator.php deafult api "$1"
php ../artisan make:model "$1"
