#!/usr/bin/perl
# $Id: echo.perl,v 1.1.1.1 2004-05-19 18:09:37 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

use Socket;

my $DATA = "Hello there sailor\n";

sub server_sock {
    local *SS;
    socket(SS, PF_INET, SOCK_STREAM, 0) or
	die "server/socket ($!)";
    setsockopt(SS, SOL_SOCKET, SO_REUSEADDR, pack("l", 1)) or
	die "server/setsockopt ($!)";
    bind(SS, sockaddr_in(0, INADDR_LOOPBACK)) or
	die "server/bind ($!)";
    listen(SS, 2);
    return(*SS);
}

sub get_port {
    local *SK = shift;
    (sockaddr_in(getsockname(SK)))[0];
}

sub client_sock {
    my $port = shift;
    local *CS;
    socket(CS, PF_INET, SOCK_STREAM, getprotobyname('tcp')) or
	die "client/socket ($!)";
    connect(CS, sockaddr_in($port, INADDR_LOOPBACK)) or
	die "client/connect ($!)";
    return(*CS);
}

sub echo_client {
    my($N, $port) = @_;
    local *SOCK = client_sock($port);
    select(SOCK);
    $| = 1;
    for my $i (0..($N-1)) {
	print $DATA;
	my $ans = <SOCK>;
	($ans eq $DATA) or die qq{client: "$DATA" ne "$ans"};
    }
    close SOCK;
}

sub echo_server {
    my($N) = @_;
    local *SSOCK = server_sock();
    my $port = get_port(*SSOCK);
    my $pid = fork;
    defined $pid or die "server/fork ($!)";
    if ($pid) {
	# parent is server
	local *CSOCK;
	accept(CSOCK, SSOCK) or die "server/accept ($!)";
	select(CSOCK);
	$| = 1;
	my $n = 0;
	while (<CSOCK>) {
	    print $_;
	    $n += length($_);
	}
	select(STDOUT);
	print "server processed $n bytes\n";
    } else {
	# child is client
	echo_client($N, $port);
    }
    wait();
}

sub main {
    my $N = $ARGV[0] || 1;
    echo_server($N);
    exit(0);
}

main();
