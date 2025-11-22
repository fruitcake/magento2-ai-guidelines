# Fruitcake AI Guidelines Module

Generate a CLAUDE.md file with project context for AI assistance.

## Installation

Option 1: Put this module in app/code in your project and run setup:upgrade

Option 2: Install as Magerun2 module:
 - Clone this library in `~/.n98-magerun2/modules`

## Usage

Generate the CLAUDE.md file at project root:

```bash
bin/magento ai:generate-context
```

This creates a `CLAUDE.md` file containing:
- System information (Magento version, PHP version, OS)
- Theme information (Hyva detection)
- Installed modules (custom and third-party)
- Project structure hints
- Magento best practices

## Customization

To customize the generated CLAUDE.md file, edit CLAUDE.md outside the `<magento-ai-guidelines>` tags.

Then regenerate:

```bash
bin/magento ai:generate-context
```

## Ideas
 - Add docs based on installed packages/versions
 - Add skills
