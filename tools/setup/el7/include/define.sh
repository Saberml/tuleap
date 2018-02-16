# declare binaries path
declare -r awk="/usr/bin/awk"
declare -r basename="/usr/bin/basename"
declare -r cat="/usr/bin/cat"
declare -r cp="/usr/bin/cp"
declare -r date="/usr/bin/date"
declare -r getenforce="/usr/sbin/getenforce"
declare -r getopt="/usr/bin/getopt"
declare -r grep="/usr/bin/grep"
declare -r gzip="/usr/bin/gzip"
declare -r head="/usr/bin/head"
declare -r install="/usr/bin/install"
declare -r ln="/usr/bin/ln"
declare -r mkdir="/bin/mkdir"
declare -r mv="/usr/bin/mv"
declare -r mysql="/opt/rh/rh-mysql57/root/usr/bin/mysql"
declare -r mysqladmin="/opt/rh/rh-mysql57/root/usr/bin/mysqladmin"
declare -r mysqldump="/opt/rh/rh-mysql57/root/usr/bin/mysqldump"
declare -r php="/opt/rh/rh-php56/root/usr/bin/php"
declare -r php_launcher="/usr/share/tuleap/src/utils/php-launcher.sh"
declare -r printf="/usr/bin/printf"
declare -r su="/bin/su"
declare -r systemctl="/usr/bin/systemctl"
declare -r tr="/usr/bin/tr"

declare -a cmd=("${awk}" "${basename}" "${cat}" "${cp}" "${date}" "${getenforce}"
                "${getopt}" "${grep}" "${gzip}" "${head}" "${install}" "${ln}"
                "${mkdir}" "${mv}" "${mysql}" "${mysqladmin}" "${mysqldump}"
                "${php}" "${printf}" "${su}" "${systemctl}" "${tr}")

# declare files path
declare -r install_dir="/usr/share/tuleap"
declare -r password_file="/root/.tuleap_passwd"
declare -r rh_release="/etc/redhat-release"
declare -r script_name="$(${basename} ${0})"
declare -r sefile="/etc/selinux/config"
declare -r src_db_forgeupgrade="/usr/share/forgeupgrade"
declare -r src_db_mysql="${install_dir}/src/db/mysql"
declare -r sql_forgeupgrade="${src_db_forgeupgrade}/db/install-mysql.sql"
declare -r sql_structure="${src_db_mysql}/database_structure.sql"
declare -r sql_init="${src_db_mysql}/database_initvalues.sql"
declare -r tuleap_dir="/etc/tuleap"
declare -r tuleap_conf="${tuleap_dir}/conf"
declare -r tuleap_plugins="${tuleap_dir}/plugins"
declare -r pluginsadministration="${tuleap_plugins}/pluginsadministration"
declare -r forgeupgrade_conf="${tuleap_dir}/forgeupgrade/config.ini"
declare -r forgeupgrade_dir="/usr/share/forgeupgrade"
declare -r forgeupgrade_dist="${install_dir}/src/etc/forgeupgrade-config.ini.dist"
declare -r local_inc="local.inc"
declare -r database_inc="database.inc"
declare -r tuleap_log="/var/log/tuleap/tuleap_setup.log"
declare -r tuleap_src="${install_dir}/src"
declare -r urandom="/dev/urandom"
declare -r nginx_conf="/etc/nginx/conf.d/tuleap.conf"

# declare options
declare -r sys_db_name="tuleap"
declare -r sys_db_user="tuleap"
declare -r my_opt="--batch --skip-column-names"
declare -r project_admin="admin"
declare -r tuleap_unix_user="codendiadm"
declare -i mysql_port=3306

declare -a timers=("tuleap-process-system-events-default.timer"
                   "tuleap-launch-system-check.timer")

assumeyes="false"
db_exist="false"
long_org_name="Tuleap ALM"
mysql_user="root"
new_db="true"
org_name="Tuleap"
server_name="NULL"
