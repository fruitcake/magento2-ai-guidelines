### Magento 2 Best Practices
- Use dependency injection (DI) via `di.xml`
- Follow PSR-12 coding standards
- Use repositories for data access
- Prefer plugins over rewrites
- Use declarative schema for database changes
- Run `bin/magento cache:clean` after configuration changes
- Run `bin/magento setup:upgrade` after adding/modifying database schema
- 
### Common File Locations
- **Controllers**: `Controller/[Adminhtml/]Action.php`
- **Blocks**: `Block/`
- **Models**: `Model/`
- **Templates**: `view/[frontend|adminhtml]/templates/`
- **Layout XML**: `view/[frontend|adminhtml]/layout/`
- **UI Components**: `view/[frontend|adminhtml]/ui_component/`
- **Web Assets**: `view/[frontend|adminhtml]/web/`

### Module Development
When creating or modifying custom modules:
1. Place custom modules in `app/code/Fruitcake/`
2. Always create `registration.php` and `module.xml`
3. Use dependency injection via `etc/di.xml`
4. Define database schema in `etc/db_schema.xml`
5. Create plugins instead of rewrites when possible
6. Add ACL resources in `etc/acl.xml` for admin functionality

### Useful commands
- `bin/magento cache:clean` - Clear cache (use after config changes)
- `bin/magento cache:flush` - Flush cache (more aggressive than clean)
- `bin/magento setup:upgrade` - Run database migrations
- `bin/magento setup:di:compile` - Compile dependency injection
- `bin/magento setup:static-content:deploy` - Deploy static content
- `bin/magento module:status` - List module status
- `bin/magento module:enable Vendor_ModuleName` - Enable a module
- `bin/magento module:disable Vendor_ModuleName` - Disable a module
- `bin/magento indexer:reindex` - Reindex all indexers

### Common Issues & Solutions

**Cache Issues**
- Problem: Changes not appearing after code modifications
- Solution: Run `bin/magento cache:clean` or `bin/magento cache:flush`

**Module Not Working**
- Check if module is enabled: `bin/magento module:status`
- Run setup upgrade: `bin/magento setup:upgrade`
- Clear cache: `bin/magento cache:clean`

**Template Changes Not Showing (Hyva)**
- Clear cache: `bin/magento cache:clean`
- Check template path is correct
- Verify you're editing the right theme

**Database Schema Changes**
- Always use `etc/db_schema.xml` (declarative schema)
- Run `bin/magento setup:upgrade` after changes
- Generate whitelist: `bin/magento setup:db-declaration:generate-whitelist`

**Permission Issues**
- Check file permissions on `var/`, `pub/`, `generated/`
- On dev: `chmod -R 777 var/ pub/ generated/` (not for production!)
- Reset permissions: Use Magento's permission script if available