/* The Computer Language Benchmarks Game
 * http://shootout.alioth.debian.org/
 * contributed by Joe Tucek 2008-03-31
 *
 * Tell GCC that we don't want atexit, we don't want to use the heap,
 * and we really don't want anything.  Can't even call write the "normal"
 * way, because write() isn't linked in....
 *
 * Compile flags are picky for this.  I used:
 * gcc -pipe -Wall -O3 -fomit-frame-pointer -march=pentium4 -ffreestanding -nostartfiles -s -static -o start3 start3.c
 */

#include <sys/syscall.h>
#include <unistd.h>

int _start() {
  syscall(__NR_write, 1, "hello world\n", 12);
  syscall(__NR_exit, 0);
  return(0);
}
