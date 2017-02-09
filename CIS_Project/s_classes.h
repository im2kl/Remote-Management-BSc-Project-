//NOTE: added precompile no warnings within project
//ERROR: having error in char* Machine_inf::getMAC()
#ifdef _MSC_VER
	#define _CRT_SECURE_NO_WARNINGS
#endif

#pragma once
// pcinfo.cpp
class Machine_inf{
	public:
	// get mac address
	char* getMAC();
	char* OS_version();
	char* lan_ip();
	char* host_name();
};

// httprp.cpp
class httprp{
	public:
	char* getrp(char*,int, char*);
	char* post_gate(char*);
	char* post_reg(char*);
	char* post_task(char*,char*);
	char* task_done(char*,int);
};

// tasks.cpp
class task{
	public:
	void msg(char*);
};