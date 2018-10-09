/*
* bf.c -- brainf*ck interpreter
*/ 

#include <stdio.h>
#include <string.h>

#define BUF_SIZE 5000

int main(int argc, char **argv) {
    char buffer[BUF_SIZE] = {};
    char code[BUF_SIZE] = {};
    int i, ptr = 0;
    scanf("%s", code);
    getchar(); // to skip '\n'
    for (i=0; i<strlen(code); i++) {
        switch (code[i]) {
            case '+':
                buffer[ptr]++;
                break;
            case '-':
                buffer[ptr]--;
                break;
            case '>':
                ptr++;
                break;
            case '<':
                ptr--;
                break;
            case '.':
                putchar(buffer[ptr]);
                break;
            case ',':
                buffer[ptr] = getchar();
                break;
            case '[':
                if (buffer[ptr] == 0) {
                    int j, depth=1;
                    for (j=i+1;;j++) {
                        if (code[j] == '[')
                            depth++;
                        else if (code[j] == ']') {
                            depth--;
                            if (depth == 0) {
                                i = j;
                                break;
                            }
                        }
                    }
                }
                break;
            case ']':
                if (buffer[ptr] != 0) {
                    int j, depth=1;
                    for (j=i-1;;j--) {
                        if (code[j] == ']')
                            depth++;
                        else if (code[j] == '[') {
                            depth--;
                            if (depth == 0) {
                                i = j;
                                break;
                            }
                        }
                    }
                }
                break;
            default:
                break;
        }
    }
    puts("");
    return 0;
}
