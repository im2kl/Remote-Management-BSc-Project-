#include "s_classes.h"

#include <iostream>
#include <sstream>
#include <vector>
#include <stdio.h>
#include <Windows.h>
#include <Iphlpapi.h>
#include <WinSock.h>
#include <Assert.h>
#pragma comment(lib, "iphlpapi.lib")
#pragma comment(lib, "wsock32.lib")


char* Machine_inf::getMAC(){
	PIP_ADAPTER_INFO AdapterInfo;
	DWORD dwBufLen = sizeof(AdapterInfo);
	char *mac_addr = (char*)malloc(17);
	
	AdapterInfo = (IP_ADAPTER_INFO *) malloc(sizeof(IP_ADAPTER_INFO));
	if (AdapterInfo == NULL) {
		//printf("Error allocating memory needed to call GetAdaptersinfo\n");
		return "MAC.GetAdaptersinfo";
	}
	// Make an initial call to GetAdaptersInfo to get the necessary size into the dwBufLen     variable
	if (GetAdaptersInfo(AdapterInfo, &dwBufLen) == ERROR_BUFFER_OVERFLOW) {
		AdapterInfo = (IP_ADAPTER_INFO *) malloc(dwBufLen);
		if (AdapterInfo == NULL) {
			//printf("Error allocating memory needed to call GetAdaptersinfo\n");
			return "MAC.GetAdaptersinfo_2";
		}
	}
	
	if (GetAdaptersInfo(AdapterInfo, &dwBufLen) == NO_ERROR) {
		PIP_ADAPTER_INFO pAdapterInfo = AdapterInfo;// Contains pointer to current adapter info
		do {
			sprintf(mac_addr, "%02X%02X%02X%02X%02X%02X",
			pAdapterInfo->Address[0], pAdapterInfo->Address[1],
			pAdapterInfo->Address[2], pAdapterInfo->Address[3],
			pAdapterInfo->Address[4], pAdapterInfo->Address[5]);
			
			return mac_addr;
			
			pAdapterInfo = pAdapterInfo->Next;        
		}while(pAdapterInfo);                        
	}
	free(AdapterInfo);
	
	
};

char* Machine_inf::OS_version(){
	int dwVersion = 0; 
	int dwMajorVersion = 0;
    int dwMinorVersion = 0; 
	int dwBuild = 0;
	
    dwVersion = GetVersion();
    // Get the Windows version.
    dwMajorVersion = (int)(LOBYTE(LOWORD(dwVersion)));
    dwMinorVersion = (int)(HIBYTE(LOWORD(dwVersion)));
	
    // Get the build number.
    if (dwVersion < 0x80000000)              
	dwBuild = (int)(HIWORD(dwVersion));
	
	char *osi = (char*)malloc(17);
	//sprintf(osi, "%d.%dv%d", dwMajorVersion, dwMinorVersion, dwBuild); includes the build id
	sprintf(osi, "%d.%d", dwMajorVersion, dwMinorVersion);
	
	return osi;
	/*
		Operating system					Version number	dwMajorVersion	dwMinorVersion
		Windows 10 Technical Preview		10.0*			10				0
		Windows Server Technical Preview	10.0*			10				0	
		Windows 8.1							6.3*			6				3	
		Windows Server 2012 R2				6.3*			6				3	
		Windows 8							6.2				6				2	
		Windows Server 2012					6.2				6				2	
		Windows 7							6.1				6				1	
		Windows Server 2008 R2				6.1				6				1	
		Windows Server 2008					6.0				6				0	
		Windows Vista						6.0				6				0
		Windows Server 2003 R2				5.2				5				2
		Windows Home Server					5.2				5				2	
		Windows Server 2003					5.2				5				2	
		Windows XP Professional x64 Edition	5.2				5				2	
		Windows XP							5.1				5				1	
		Windows 2000						5.0				5				0	
	*/
	
};

char* Machine_inf::lan_ip(){
	WORD wVersionRequested;
	WSADATA wsaData;
	char name[255];
	PHOSTENT hostinfo;
	
	wVersionRequested = MAKEWORD( 1, 1 );
	char* ip;
	
	if ( WSAStartup( wVersionRequested, &wsaData ) == 0 )
	if( gethostname ( name, sizeof(name)) == 0)
	{
		
		if((hostinfo = gethostbyname(name)) != NULL){
			int nCount = 0;
			while(hostinfo->h_addr_list[nCount]){
				ip = inet_ntoa(*(
				struct in_addr *)hostinfo->h_addr_list[nCount]);
				++nCount;
			}
		}
	}
	return ip;
};

char* Machine_inf::host_name(){
	WORD wVersionRequested;
	WSADATA wsaData;
	char name[255];
	char* host;
	
	wVersionRequested = MAKEWORD( 1, 1 );
	if ( WSAStartup( wVersionRequested, &wsaData ) == 0 ){
		if( gethostname ( name, sizeof(name)) == 0)
		{
			host = strdup(name); // conver from char[] to char*
		}
	}
	return host;
};

