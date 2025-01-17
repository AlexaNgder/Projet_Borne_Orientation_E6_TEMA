/* Simple C program that connects to MySQL Database server*/
#include <mysql/mysql.h>
#include <stdio.h>

int main(void) {
   MYSQL *conn;
   MYSQL_RES *res;
   MYSQL_ROW row;

   char *server = "localhost";
   char *user = "root";
   char *password = "snir"; /* set me first */
   char *database = "TOUSPROJETS";

   conn = mysql_init(NULL);

   /* Connect to database */
   if (!mysql_real_connect(conn, server,
         user, password, database, 0, NULL, 0)) {
      fprintf(stderr, "%s\n", mysql_error(conn));
      exit(1);
   }

   mysql_query(conn, "INSERT INTO temperature (Temp) VALUES(30), (15);") ;

   /* close connection */
   mysql_free_result(res);
   mysql_close(conn);
}

