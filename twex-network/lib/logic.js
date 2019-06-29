/**
 * Store Login form values into Hyperledger Blockchain
 * @param {org.twex.poc.ProjectAction} tx  Complete the project
 * @transaction
 */
async function ProjectAction(tx) 
{
  tx.project.status = tx.Projectstatus;
  const assetRegistry = await getAssetRegistry('org.twex.poc.Project');
  await assetRegistry.update(tx.project);  
}

