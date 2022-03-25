<?php
header('Content-type: text/plain');
?>
<?php
header('Content-Disposition: attachment; filename="dogecoin.conf"');
?>
##
## dogecoin.conf configuration file. Lines beginning with # are comments.
##

# Network-related settings:

# Run on the test network instead of the real dogecoin network.
#testnet=0

# Run a regression test network
#regtest=0

# Connect via a SOCKS5 proxy
#proxy=127.0.0.1:9050

# Bind to given address and always listen on it. Use [host]:port notation for IPv6
#bind=<addr>

# Bind to given address and whitelist peers connecting to it. Use [host]:port notation for IPv6
#whitebind=<addr>

##############################################################
##            Quick Primer on addnode vs connect            ##
##  Let's say for instance you use addnode=4.2.2.4          ##
##  addnode will connect you to and tell you about the      ##
##    nodes connected to 4.2.2.4.  In addition it will tell ##
##    the other nodes connected to it that you exist so     ##
##    they can connect to you.                              ##
##  connect will not do the above when you 'connect' to it. ##
##    It will *only* connect you to 4.2.2.4 and no one else.##
##                                                          ##
##  So if you're behind a firewall, or have other problems  ##
##  finding nodes, add some using 'addnode'.                ##
##                                                          ##
##  If you want to stay private, use 'connect' to only      ##
##  connect to "trusted" nodes.                             ##
##                                                          ##
##  If you run multiple nodes on a LAN, there's no need for ##
##  all of them to open lots of connections.  Instead       ##
##  'connect' them all to one node that is port forwarded   ##
##  and has lots of connections.                            ##
##       Thanks goes to [Noodle] on Freenode.               ##
##############################################################

# Use as many addnode= settings as you like to connect to specific peers
#addnode=69.164.218.197
#addnode=10.0.0.2:22556

# Alternatively use as many connect= settings as you like to connect ONLY to specific peers
#connect=69.164.218.197
#connect=10.0.0.1:22556

# Listening mode, enabled by default except when 'connect' is being used
listen=1

# Maximum number of inbound+outbound connections.
#maxconnections=

#
# JSON-RPC options (for controlling a running Dogecoin/dogecoind process)
#

# server=1 tells Dogecoin-Qt and dogecoind to accept JSON-RPC commands
server=1
daemon=1

# Bind to given address to listen for JSON-RPC connections. Use [host]:port notation for IPv6.
# This option can be specified multiple times (default: bind to all interfaces)
rpcbind=<?php echo $_POST["rpclip"]."\n"; ?>

# If no rpcpassword is set, rpc cookie auth is sought. The default `-rpccookiefile` name
# is .cookie and found in the `-datadir` being used for dogecoind. This option is typically used
# when the server and client are run as the same user.
#
# If not, you must set rpcuser and rpcpassword to secure the JSON-RPC api. The first
# method(DEPRECATED) is to set this pair for the server and client:
rpcuser=<?php echo $_POST["rpcuser"]."\n"; ?>
rpcpassword=<?php echo $_POST["rpcpassword"]."\n"; ?>
#
# The second method `rpcauth` can be added to server startup argument. It is set at intialization time
# using the output from the script in share/rpcuser/rpcuser.py after providing a username:
#
# ./share/rpcuser/rpcuser.py alice
# String to be appended to dogecoin.conf:
# rpcauth=alice:f7efda5c189b999524f151318c0c86$d5b51b3beffbc02b724e5d095828e0bc8b2456e9ac8757ae3211a5d9b16a22ae
# Your password:
# DONT_USE_THIS_YOU_WILL_GET_ROBBED_8ak1gI25KFTvjovL3gAM967mies3E=
#
# On client-side, you add the normal user/password pair to send commands:
#rpcuser=alice
#rpcpassword=DONT_USE_THIS_YOU_WILL_GET_ROBBED_8ak1gI25KFTvjovL3gAM967mies3E=
#
# You can even add multiple entries of these to the server conf file, and client can use any of them:
# rpcauth=bob:b2dd077cb54591a2f3139e69a897ac$4e71f08d48b4347cf8eff3815c0e25ae2e9a4340474079f55705f40574f4ec99

# How many seconds dogecoin will wait for a complete RPC HTTP request.
# after the HTTP connection is established.
#rpcclienttimeout=30

# By default, only RPC connections from localhost are allowed.
# Specify as many rpcallowip= settings as you like to allow connections from other hosts,
# either as a single IPv4/IPv6 or with a subnet specification.

# NOTE: opening up the RPC port to hosts outside your local trusted network is NOT RECOMMENDED,
# because the rpcpassword is transmitted over the network unencrypted.

# server=1 tells Dogecoin-Qt to accept JSON-RPC commands.
# it is also read by dogecoind to determine if RPC should be enabled
#rpcallowip=10.1.1.34/255.255.255.0
#rpcallowip=1.2.3.4/24
#rpcallowip=2001:db8:85a3:0:0:8a2e:370:7334/96
rpcallowip=<?php echo $_POST["rpcdip"]."\n"; ?>
rpcallowip=<?php echo $_POST["rpclip"]."\n"; ?>
# Listen for RPC connections on this TCP port:
rpcport=22555

# You can use Dogecoin or dogecoind to send commands to Dogecoin/dogecoind
# running on another host using this option:
rpcconnect=<?php echo $_POST["rpclip"]."\n"; ?>

# Transaction Fee Changes in 0.10.0

# Send transactions as zero-fee transactions if possible (default: 0)
#sendfreetransactions=0

# Create transactions that have enough fees (or priority) so they are likely to begin confirmation within n blocks (default: 1).
# This setting is over-ridden by the -paytxfee option.
#txconfirmtarget=n

# Miscellaneous options

# Pre-generate this many public/private key pairs, so wallet backups will be valid for
# both prior transactions and several dozen future transactions.
#keypool=100

# Pay an optional transaction fee every time you send dogecoins.  Transactions with fees
# are more likely than free transactions to be included in generated blocks, so may
# be validated sooner.
#paytxfee=0.00

# User interface options

# Start Dogecoin minimized
#min=1

# Minimize to the system tray
#minimizetotray=1

## Use this for Dogecoin development and blockchain analysis
# Note uncommenting this line will make Dogecoin rescan the whole blockchain which can takes several days
# txindex=1