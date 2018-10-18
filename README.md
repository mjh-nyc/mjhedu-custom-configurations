# Musuem of Jewish Heritage Education Custom Configurations

This plugin registers Musuem of Jewish Heritage custom configurations and manages acf-pro syncs.

This plugin is always activated since it is a must use plugin.

## ACF pro syncs

Since composer requires special modifications to work with git for package managment, it relies on git tags and not the has references, adding extra steps for deployment.
ACF pro creates jSON file backups on every save in the UI. These are stored in the `acf-json` directory within this plugin. 

### Development
If you are planning to work on acf-pro, here are the steps to follow:
1. Make sure your under the master branch of this plugin before beginning development running `git checkout master` and then `git pull origin master`, since composer checks you out to the tag reference.
2. Once you complete your development with acf pro within wordpress, commit all jSON files to the master branch ( `git add acf-pro` and then `git commit`) and push to the remote (`git push origin master`)
3. If this is ready to be shared to the entire project, we need to tag a release (`git tag 1.0.*` where asterisk is the next version number. You can view all current tags running `git tag -l` )
4. Now we need to push the tag `git push origin --tags`
5. Change directory to the project root.
6. Open the composer.json
7. Under `repositories` configs, look for this plugin `mjh-nyc/mjh-custom-configurations` and update the `reference` value under `source` to the tag you added
8. You can run `composer update` to checkout your plugin to the tag (optional if you plan to do more work)
9. Commit composer files to root

### Syncing
Acf-pro provides a UI to sync jSON file to the current wordpress installation so that your field groups and synced with the files stored in the repository. You can do them all or specific field groups.
Please follow documentation for syncing
[https://www.advancedcustomfields.com/resources/synchronized-json/] (https://www.advancedcustomfields.com/resources/synchronized-json/)
