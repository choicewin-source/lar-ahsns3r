import os

def list_project_files(startpath, output_file='project_structure.txt'):
    ignored_dirs = {'.git', 'node_modules', 'vendor', '__pycache__', '.idea', '.vscode', 'storage'}
    
    with open(output_file, 'w', encoding='utf-8') as f:
        f.write(f"Project Structure for: {os.path.abspath(startpath)}\n")
        f.write("="*50 + "\n\n")
        
        for root, dirs, files in os.walk(startpath):
            dirs[:] = [d for d in dirs if d not in ignored_dirs]
            level = root.replace(startpath, '').count(os.sep)
            indent = ' ' * 4 * (level)
            f.write(f"{indent}[{os.path.basename(root)}/]\n")
            
            subindent = ' ' * 4 * (level + 1)
            for file in files:
                if file == output_file or file.startswith('.'):
                    continue
                f.write(f"{subindent}{file}\n")

    print(f"تم حفظ هيكلية المشروع في الملف: {output_file}")

if __name__ == "__main__":
    list_project_files('.')
