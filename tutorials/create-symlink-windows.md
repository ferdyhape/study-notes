# Create Symlink, Junction, and Hard Link in Windows

---

## What is a Link?

A link is a reference to a file or directory. It saves disk space by pointing to the original instead of copying.

---

## Three Types of Links

| Type          | Works With      | Cross-Drive | Admin | Command                 |
| :------------ | :-------------- | :---------- | :---- | :---------------------- |
| **Symlink**   | Files & Folders | Yes         | Yes   | `mklink /D` or `mklink` |
| **Junction**  | Folders only    | Yes         | No    | `mklink /J`             |
| **Hard Link** | Files only      | No          | No    | `mklink /H`             |

---

## Symbolic Link (Symlink)

### For Folders

```cmd
mklink /D "link_path" "target_path"
```

**Example:**

```cmd
mklink /D "C:\Desktop\MyFolder" "D:\Projects\MyFolder"
```

### For Files

```cmd
mklink "link_path" "target_path"
```

**Example:**

```cmd
mklink "C:\Desktop\config.ini" "C:\AppData\config.ini"
```

> **Note**: Requires Administrator privileges

---

## Junction

### For Folders Only

```cmd
mklink /J "link_path" "target_path"
```

**Example:**

```cmd
mklink /J "C:\Desktop\MyFolder" "D:\Projects\MyFolder"
```

> **Note**: No admin required

---

## Hard Link

### For Files Only

```cmd
mklink /H "link_path" "target_path"
```

**Example:**

```cmd
mklink /H "C:\Desktop\config.ini" "C:\AppData\config.ini"
```

> **Note**: Both files must be on the same drive

---

## How to Use

1. **Open Command Prompt as Administrator** (for symlink only)
   - Press `Win + R`
   - Type `cmd`
   - Press `Ctrl + Shift + Enter`

2. **Run the command**

   ```cmd
   mklink /D "C:\Desktop\MyFolder" "D:\Projects\MyFolder"
   ```

3. **Verify**
   ```cmd
   dir C:\Desktop
   ```

---

## Remove a Link

```cmd
rmdir "link_path"
```

Or:

```cmd
del "link_path"
```

> **Warning**: Only deletes the link, not the target

---

## Common Errors

| Error          | Cause                 | Solution                 |
| :------------- | :-------------------- | :----------------------- |
| Access Denied  | Not admin             | Run as Administrator     |
| Path not found | Wrong path            | Check target path exists |
| Already exists | Link exists           | Delete it first          |
| Different disk | Hard link cross-drive | Use symlink instead      |

---

## When to Use

- **Symlink**: Need to link files or folders across drives
- **Junction**: Link folders without admin rights
- **Hard Link**: Link files on the same drive
