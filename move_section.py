import sys

with open('/Users/air/Downloads/MWALAFYALE/resources/views/home.blade.php', 'r') as f:
    lines = f.readlines()

start_idx = -1
end_idx = -1
for i, line in enumerate(lines):
    if '<section id="lead-capture"' in line:
        start_idx = i
    if start_idx != -1 and '</section>' in line:
        end_idx = i
        break

if start_idx != -1 and end_idx != -1:
    block = lines[start_idx:end_idx+1]
    del lines[start_idx:end_idx+1]
    
    insert_idx = -1
    for i, line in enumerate(lines):
        if '<section id="about"' in line:
            insert_idx = i
            break
            
    if insert_idx != -1:
        # insert empty line before
        block.append('\n')
        lines = lines[:insert_idx] + block + lines[insert_idx:]
        
        with open('/Users/air/Downloads/MWALAFYALE/resources/views/home.blade.php', 'w') as f:
            f.writelines(lines)
        print("Moved successfully.")
    else:
        print("Could not find insert location.")
else:
    print("Could not find section.")
