#!/usr/bin/perl
# $Id: except.perl,v 1.1.1.1 2004-05-19 18:09:43 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

use integer;

my $HI = 0;
my $LO = 0;
my $NUM = $ARGV[0];
$NUM = 1 if ($NUM < 1);

package Lo_Exception;

sub new {
    bless({Val => shift}, __PACKAGE__);
}

package Hi_Exception;

sub new {
    bless({Val => shift}, __PACKAGE__);
}

package main;

sub some_function {
    my $num = shift;
    eval {
	&hi_function($num);
    };
    if ($@) {
	die "We shouldn't get here ($@)";
    }
}

sub hi_function {
    my $num = shift;
    eval {
	&lo_function($num);
    };
    if (ref($@) eq "Hi_Exception") {
	$HI++;		# handle
    } elsif ($@) {
	die $@;		# rethrow
    }
}

sub lo_function {
    my $num = shift;
    eval {
	&blowup($num);
    };
    if (ref($@) eq "Lo_Exception") {
	$LO++;		# handle
    } elsif ($@) {
	die $@;		# rethrow
    }
}

sub blowup {
    my $num = shift;
    if ($num % 2) {
	die Lo_Exception->new(Num => $num);
    } else {
	die Hi_Exception->new(Num => $num);
    }
}

$NUM = $ARGV[0];
while ($NUM--) {
    &some_function($NUM);
}
print "Exceptions: HI=$HI / LO=$LO\n";
