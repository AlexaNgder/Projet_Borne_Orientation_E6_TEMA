#include <stdio.h>

typedef struct {
    char nom[50];
    char prenom[50];
    char grade[20];
    float salaire;
    char adresse[100];
    struct prof *autreProf;  // Pointeur vers un autre professeur
} prof;

int main() {
    prof p1 = {
        "Dupont",
        "Jean",
        "Certifié",
        2500.50,
        "123 rue de Paris, 75000 Paris",
        NULL  // Pas de lien avec un autre professeur pour l'exemple
    };
    
    printf("Nom du professeur : %s\n", p1.nom);
    printf("Prénom du professeur : %s\n", p1.prenom);
    printf("Grade : %s\n", p1.grade);
    printf("Salaire : %.2f euros\n", p1.salaire);
    printf("Adresse : %s\n", p1.adresse);

    return 0;
}

