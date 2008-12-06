#!/usr/bin/perl

# The Great Computer Language Shootout
#  http://shootout.alioth.debian.org/
#
#   contributed by John O'Hare 03 August 2005.

use strict;
use warnings;
use Socket;

use constant PORT_NUMBER => 	12331;
use constant M => 		100;
use constant REPLY_SIZE => 	4096;
use constant REQUEST_SIZE => 	64;

my $n = 1;
$n = $ARGV[0] if (defined($ARGV[0]));
$n *= M;

unless (fork) { #client
	sleep 2; #wait for the server to start

	my $cbuf;
	my $request = chr(60)x REQUEST_SIZE;
	my $bytes = 0;
	my $replies = 0;

	socket(CSOCK, PF_INET, SOCK_STREAM, getprotobyname('tcp')) || die $!;
	connect(CSOCK, sockaddr_in(PORT_NUMBER, INADDR_LOOPBACK)) or die $!;

	while ($n--) {
		my $tmpbytes = 0;
		defined(send(CSOCK, $request, 0)) or die $!;
		while (($tmpbytes += sysread(CSOCK, $cbuf, REPLY_SIZE)) < REPLY_SIZE) {}
		$bytes += $tmpbytes;
		$replies++;
	}

	shutdown(CSOCK, 2);
	print "replies: $replies\tbytes: $bytes\n";
	exit(0);
}

#server
my $reply = chr(62)x REPLY_SIZE;
my $sbuf;

socket(SSOCK, PF_INET, SOCK_STREAM, getprotobyname('tcp')) || die $!;
bind (SSOCK, sockaddr_in(PORT_NUMBER, INADDR_LOOPBACK)) || die $!;

listen (SSOCK, 1);

accept (CONN, SSOCK) || die $!;

while (sysread(CONN, $sbuf, REQUEST_SIZE)) {
	defined(send(CONN, $reply, 0)) or die $!;
}

shutdown(CONN, 2);
shutdown(SSOCK, 2);
