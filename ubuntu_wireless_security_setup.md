# Netgear WN311B and Ubuntu 12.04 TLS

Wireless network cards can be troublesome to deal with on Ubuntu. This is made harder when using a version of Ubuntu with no GUI.

I recently installed Ubuntu Server 12.04 TLS onto my home machine and wanted to connect to the internet via my wireless card.

This card is the Netgear WN311B, which has had some driver issues with Ubuntu in the past. Luckily Ubuntu 12.04 seems to be fairly on top of its game in this regard.

After many, many missetps, here is how I was able to successfully connect to my Linksys wireless router.

First, check if your wireless card is being read.

	$ iwconfig

Your output might be something like:

```
lo        no wireless extensions.
eth0      no wireless extensions.
sit0      no wireless extensions.
wlan0     IEEE 802.11bg  ESSID:"linksys_SES_14440"  
          Mode:Managed  Frequency:2.437 GHz  Access Point: 00:1C:10:25:1B:FB   
          Bit Rate=54 Mb/s   Tx-Power=20 dBm   
          Retry  long limit:7   RTS thr:off   Fragment thr:off
          Power Management:off
          Link Quality=56/70  Signal level=-54 dBm  
          Rx invalid nwid:0  Rx invalid crypt:0  Rx invalid frag:0
          Tx excessive retries:3  Invalid misc:54   Missed beacon:0
```
What you're hoping to see is the `wlan0` entry. Luckily after a clean install of Ubuntu 12.04, I saw it being recognized. If you do not see yours, you'll have some extra legwork (And google searches) to do. See [here](https://help.ubuntu.com/community/WifiDocs/WiFiHowTo) for some more information where it says `If all devices listed say "no wireless extensions."`

The solution for me was actually in BIOS. I had to enable the correct piece of hardware.

Now, if you're like me and you have some security setup on your wireless network, then you're not done yet.

First, Ubuntu 12.04 didn't have the drivers for the WN311B. Let's get those:

	$ sudo apt-get install firmware-b43-installer

Almost done. The next step is to setup your `/etc/network/interfaces` file appropriately. I have a Linksys wireless router using WPA Personal encryption and TKIP WPA algorithm. To find out what you are using, log into your [Router control panel](http://www.brighthub.com/computing/hardware/articles/39383.aspx). If you're not using a Linksys, check for the control panel for your specific brand of router.

I found the proper setup the interfaces file from this [excellent forum post](http://ubuntuforums.org/showthread.php?t=202834 "Ubuntu Wireless security"). Note near the bottom of the post where there are many examples of different setups. This was appropriate for my setup, using the above-mentioned security settings.

```
auto wlan0
iface wlan0 inet dhcp  #DHCP, as opposted to a static IP
wpa-driver wext
wpa-ssid <your_essid - can be taken directly from router control panel>
wpa-ap-scan 1	#My SSID is being broadcasted
wpa-proto WPA	#Using WPA1 (Appropriate for WPA Personal)
wpa-pairwise TKIP 	#Using TKIP as opposted to AED
wpa-group TKIP		#Using TKIP as opposted to AED
wpa-key-mgmt WPA-PSK
wpa-psk <your_hex_key - can be taken directly from router>
```
**Note** the explanation of what each one setting means and available options. The section marked `VERY IMPORTANT ("WPA PSK Key Generation")` I skipped. I took the hex_key directly from the router control panel where it said `WPA Shared Key` under Wireless Security.

After that, I ran:

	sudo /etc/init.d/networking restart
	
This process hung for me for a little bit, but eventually finished. I was connected to the internet, which I tested using:

	ping -c 3 google.com

Voila. Intertubes.
