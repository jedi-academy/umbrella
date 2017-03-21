#Panda Research Center - API Guide

These are the commands/endpoints implemented in the Panda Research Center (PRC)
server. Some are intended for use a a bot factory webapp, but some can
be invoked from your browser location field, for testing.

If using these under program control, 

    $response = file_get_contents('https://umbrella.jlparry.com/xxx?token=zzz');

will retrieve the response to a request sent to "xxx", which
refers to an endpoint described below, and may need additional
parameters,

The "token" query parameter is required for any request meant to be used only
by a bot factory app request. The value is a PRC session identifier, good for
the current PRC trading session, and provided to you through the "registerme"
endpoint. This is different from the super secret token you use to change
deployment settings.

In all cases below, the response might be an error message instead
of the "happy path" response shown.

## /box

Purpose: purchase a box of random parts for this factory to use  
Returns: an array of parts certificates, in JSON format  
Used by: bot factory app  
Status: beta

Each box contains 10 random bot parts.
The purchase price of $100 per box is deducted from your factory's balance.


## /build

Purpose: Requests any newly built parts for this factory  
Returns: an array of parts certificates, in JSON format  
Used by: bot factory app  
Status: t.b.d.

Each bot factory makes one specific part during a business cycle of the PRC.
The factory gets to "make" one part every 10 seconds. This method creates
certificates of authenticity for your recent parts built, to a maximum of 10.
The "last built" timestamp resets every time this method is called, so calling 
it every nine seconds will result in no production for your factory!

## /buyme/part1/part2/part3

Purpose: Ask the PRC to buy an assembled bot from you  
Returns: Ok (or not)  
Used by: bot factory app  
Status: t.b.d.

The PRC will automatically credit your account balance, if the request
checks out.
The certificates for any pieces "consumed" will be voided.

## /goodbye

Purpose: Destroy your plants' PRC trading session  
Returns: Ok (or not)  
Used by: bot factory app  
Status: alpha

Your factory will then need to "register" again

## /myjob/team

Purpose: Identify a factory's job  
Returns: The specific part that a factory is manufacturing during the current trading session  
Used by: browser or bot factory app  
Status: beta

Use this for debugging, at the moment.

## /rebootme

Purpose: Start your bot factory over  
Returns: Ok (or not)  
Used by: bot factory app  
Status: t.b.d.

If successful, any parts certificates assigned to your factory will be voided,
and your balance will be reset to the starting amount, i.e. $1000.

## /registerme/team/token

Purpose: Establish a trading session on PRC for your factory  
Returns: Ok and your PRC trading session key (or not)  
Used by: bot factory app  
Status: t.b.d.

Create or refresh the PRC session for your factory.
Without a session, factory requests will be ignored.
Use this if your IP address changes, for instance.
A factory can have only one session open at a time.

## /scoop/team

Purpose: Get the scoop on a factory  
Returns: the data known about a plant, identified by its name  
Used by: browser or bot factory app  
Status: t.b.d.

Use this to see what the PRC thinks a given factory has, in terms
of its balance and the parts it has on hand.


## /verify/token

Purpose: Identify a part  
Returns: the data known about a part, identified by its certificate token  
Used by: browser *or* bot factory app  
Status: t.b.d.

## /whoami

Purpose: Test if you have a PRC session  
Returns: The factory name the PRC associates with your IP address  
Used by: bot factory app  
Status: tested

This should return your factory name, if you have a PRC session.
