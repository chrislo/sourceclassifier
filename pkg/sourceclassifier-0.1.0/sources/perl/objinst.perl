#!/usr/bin/perl 
# $Id: objinst.perl,v 1.1.1.1 2004-05-19 18:11:03 bfulgham Exp $
# http://www.bagley.org/~doug/shootout/

use strict;


package Toggle;

sub new {
    my($class, $start_state) = @_;
    bless( { Bool => $start_state }, $class );
}

sub value {
    my $self = shift;
    return($self->{Bool});
}

sub activate {
    my $self = shift;
    $self->{Bool} ^= 1;
    return($self);
}


package NthToggle;
@NthToggle::ISA = qw(Toggle);

sub new {
    my($class, $start_state, $max_counter) = @_;
    my $self = $class->SUPER::new($start_state);
    $self->{CountMax} = $max_counter;
    $self->{Counter} = 0;
    return($self);
}

sub activate {
    my $self = shift;
    if (++$self->{Counter} >= $self->{CountMax}) {
	$self->{Bool} ^= 1;
	$self->{Counter} = 0;
    }
    return($self);
}


package main;

sub main {
    my $NUM = ($ARGV[0] > 0) ? $ARGV[0] : 1;

    my $toggle = Toggle->new(1);
    for (1..5) {
	print (($toggle->activate->value) ? "true\n" : "false\n");
    }
    for (1..$NUM) {
	$toggle = Toggle->new(1);
    }

    print "\n";

    my $ntoggle = NthToggle->new(1, 3);
    for (1..8) {
	print (($ntoggle->activate->value) ? "true\n" : "false\n");
    }
    for (1..$NUM) {
	$ntoggle = NthToggle->new(1, 3);
    }
}

main();

