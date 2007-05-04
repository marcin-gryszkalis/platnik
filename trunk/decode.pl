#!/usr/bin/perl -w
# $Id$
# mg@fork.pl

$enc = shift;

sub swap($$)
{
    $_ = shift;
    $n = shift;
    s/(.{$n})(.{$n})/$2$1/g;
    return $_;
}

$k = "lmnopqrstuvwxyz{";

@pkey = (
swap($k, 8),
swap(swap($k, 4), 1),
swap(swap($k, 8), 1),
swap($k, 1),
swap($k, 4),
swap($k, 2),
swap(swap($k, 2), 1),
swap(swap(swap($k, 4), 2), 1),
);

@order = (0,1,2,3,4,0,3,5,2,1,5,4,3,6,6,2,4,2,2,4,3,2,7,7);

$i = 0;
sub dec($$)
{
    $a = index $pkey[$order[$i]], shift;
    $b = index $pkey[$order[$i]], shift;
    $i++;
    return chr hex sprintf "%x%x",$b,$a;
}

$enc =~ s/[^$k]//g;
$enc =~ s/(.)(.)/dec($1,$2)/ge;
print "$enc\n";
