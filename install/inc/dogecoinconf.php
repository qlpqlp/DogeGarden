<?php
header('Content-type: text/plain');
?>
<?php
header('Content-Disposition: attachment; filename="dogecoin.conf"');
?>
##
## dogecoin.conf configuration file. Lines beginning with # are comments.
##

#
# JSON-RPC options (for controlling a running Dogecoin/dogecoind process)
#

uacomment=DogeGarden

# If no rpcpassword is set, rpc cookie auth is sought. The default `-rpccookiefile` name
# is .cookie and found in the `-datadir` being used for dogecoind. This option is typically used
# when the server and client are run as the same user.
#
# If not, you must set rpcuser and rpcpassword to secure the JSON-RPC api. The first
# method(DEPRECATED) is to set this pair for the server and client:
rpcuser=<?php echo $_POST["rpcuser"]."\n"; ?>
rpcpassword=<?php echo $_POST["rpcpassword"]."\n"; ?>

# server=1 tells Dogecoin-Qt and dogecoind to accept JSON-RPC commands
server=1
daemon=1
listen=1

# Bind to given address to listen for JSON-RPC connections. Use [host]:port notation for IPv6.
# This option can be specified multiple times (default: bind to all interfaces)
rpcbind=<?php echo $_POST["rpclip"]; ?>

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
rpcallowip=<?php echo $_POST["rpcdip"]; ?>
rpcallowip=<?php echo $_POST["rpclip"]; ?>
rpcallowip=127.0.0.1

# You can use Dogecoin or dogecoind to send commands to Dogecoin/dogecoind
# running on another host using this option:
rpcconnect=<?php echo $_POST["rpclip"]; ?>

# Listen for RPC connections on this TCP port:
rpcport=22555