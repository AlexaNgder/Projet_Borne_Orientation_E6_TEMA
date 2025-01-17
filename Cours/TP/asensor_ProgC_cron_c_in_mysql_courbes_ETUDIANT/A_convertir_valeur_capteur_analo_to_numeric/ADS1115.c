// Distributed with a free-will license.
// Use it any way you want, profit or free, provided it fits in the licenses of its associated works.
// ADS1115
// This code is designed to work with the ADS1115_I2CADC I2C Mini Module available from ControlEverything.com.
// https://www.controleverything.com/content/Analog-Digital-Converters?sku=ADS1115_I2CADC#tabs-0-product_tabset-2

#include <stdio.h>
#include <stdlib.h>
//pour autoriser i2c faire au demarrage de la rpi
// sudo raspi-config cliquer interfacing options
// et autoriser i2c enable
#include <linux/i2c-dev.h>
#include <sys/ioctl.h>
#include <fcntl.h>
// pour compiler gcc ADS1115.c -o essai

void main() 
{
	// Create I2C bus
	int file;
	char *bus = "/dev/i2c-1";
	if ((file = open(bus, O_RDWR)) < 0) 
	{
		printf("Impossible d'ouvrir le bus. \n");
		exit(1);
	}
	// Get I2C device, ADS1115 I2C address is 0x48(72)
	//Obtenez le périphérique I2C, l'adresse ADS1115 I2C est 0x48 (72) 
	ioctl(file, I2C_SLAVE, 0x48);// envoyer a la rpi l'adresse ADS1115 I2C 0x48

	// Select configuration register(0x01)
	// Sélectionnez le registre de configuration(0x01)
	// AINP = AIN0 and AINN = AIN1, +/- 2.048V
	// Continuous conversion mode, 128 SPS(0x84, 0x83)
	// Mode de conversion continue,
	char config[3] = {0};
	config[0] = 0x01; //0x01 = registre des modifications
	config[1] = 0x84;
	config[2] = 0x83;
	write(file, config, 3); //config dans le fichier deja ouvert"file" 
	sleep(1);

	// Read 2 bytes of data from register(0x00)
	// Lire 2 octets de données du registre
	// raw_adc msb, raw_adc lsb
	char reg[1] = {0x00};
	write(file, reg, 1);
	char data[2]={0};
	if(read(file, data, 2) != 2)
	{
		printf("Erreur: Erreur d'entrée / sortie \n");
	}
	else 
	{
		// Convert the data
		int raw_adc = (data[0] * 256 + data[1]);
		if (raw_adc > 32767)
		{
			raw_adc -= 65535;
		}

		// Output data to screen
		printf("Digital Value of Analog Input: %d \n", raw_adc);
	}
}
